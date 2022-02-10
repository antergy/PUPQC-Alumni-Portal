<?php

namespace App\Http\Controllers\API\Reports;

use Illuminate\Support\Facades\DB;

/**
 * Class PostsReportData
 * @package App\Http\Controllers\API\Reports
 */
class PostsReportData
{
    /**
     * @return array
     */
    public function generateReportData()
    {
        return [
            'created_posts_per_day' => $this->getCreatedPostPerDay(),
            'all_posts'             => $this->getCountAllPostPerType(),
            'comments'              => $this->getCountCommentedPostsPerType(),
            'likes'                 => $this->getCountLikedPostsPerType(),
        ];
    }

    private function getCreatedPostPerDay()
    {
        $aResult = DB::table('t_posts')
            ->select(DB::raw('DATE(t_posts.created_at) as type'), DB::raw('count(t_posts.post_id) as value'))
            ->groupBy(DB::raw('DATE(t_posts.created_at)'))
            ->orderBy('t_posts.created_at', 'asc')
            ->limit(10)
            ->get()->toArray();
        return $this->flattenData($aResult);
    }

    private function getCountAllPostPerType()
    {
        $aResult = DB::table('t_posts')
            ->select('r_post_types.pt_desc as type', DB::raw('count(t_posts.post_id) as value'))
            ->rightJoin('r_post_types', 'r_post_types.pt_id', 't_posts.post_pt_id')
            ->where('r_post_types.status', '<>', 0)
            ->groupBy('r_post_types.pt_desc')
            ->get()->toArray();
        return $this->flattenData($aResult);
    }

    private function getCountCommentedPostsPerType()
    {
        $aResult = DB::table('t_comments')
            ->select('r_post_types.pt_desc as type', DB::raw('count(t_comments.cm_id) as value'))
            ->join('t_posts', 't_posts.post_id', 't_comments.cm_post_id')
            ->rightJoin('r_post_types', 'r_post_types.pt_id', 't_posts.post_pt_id')
            ->where('r_post_types.status', '<>', 0)
            ->groupBy('r_post_types.pt_desc')
            ->get()->toArray();
        return $this->flattenData($aResult);
    }

    private function getCountLikedPostsPerType()
    {
        $aResult = DB::table('t_likes')
            ->select('r_post_types.pt_desc as type', DB::raw('count(t_likes.lk_id) as value'))
            ->join('t_posts', 't_posts.post_id', 't_likes.lk_post_id')
            ->rightJoin('r_post_types', 'r_post_types.pt_id', 't_posts.post_pt_id')
            ->where('r_post_types.status', '<>', 0)
            ->groupBy('r_post_types.pt_desc')
            ->get()->toArray();
        return $this->flattenData($aResult);
    }

    private function flattenData(array $aData)
    {
        $aResult = [];
        foreach ($aData as $aValue) {
            $aResult[$aValue->type] = $aValue->value;
        }
        return $aResult;
    }
}
