<?php

namespace App\Http\Controllers\API\Reports;

use Carbon\Carbon;
use http\Env\Request;
use Illuminate\Support\Facades\DB;
use function Symfony\Component\Translation\t;

/**
 * Class TracerReportData
 * @package App\Http\Controllers\API\Reports
 */
class TracerReportData
{
    const EXTENT = [
        0 => 'Not applicable',
        1 => 'Not at all',
        2 => 'Little extent',
        3 => 'Good extent',
        4 => 'Great extent',
        5 => 'Very great extent'
    ];
    const RELEVANCE = [
        0 => 'Not applicable',
        1 => 'Not relevant',
        2 => 'Of little relevance',
        3 => 'Somewhat relevant',
        4 => 'Relevant',
        5 => 'Extremely relevant'
    ];
    const ACCEPTANCE = [
        0 => 'Not applicable',
        1 => 'Strongly disagree',
        2 => 'Disagree',
        3 => 'Neither agree nor disagree',
        4 => 'Agree',
        5 => 'Strongly agree'
    ];

    /**
     * @return array
     */
    public function generateReportData()
    {
        return $this->getLikertScaleAnswerData();
    }

    private function getLikertScaleAnswerData()
    {
        $aResult = DB::table('r_form_answers')
            ->select(DB::raw('secondary_fqt.fqt_desc as secondary_fqt'), DB::raw('r_form_question_group.fqg_desc as question_group'), DB::raw('count(r_form_answers.fa_id) as value'), DB::raw('r_form_questions.fq_desc as question'), DB::raw('r_form_question_type.fqt_desc as question_type'), DB::raw('r_form_answers.fa_is_secondary_answer as secondary_answer'), DB::raw('r_form_answers.fa_answer as answer'),)
            ->join('r_form_questions', 'r_form_questions.fq_id', 'r_form_answers.fa_fq_id')
            ->join('r_form_question_type', 'r_form_question_type.fqt_id', 'r_form_questions.fq_fqt_id')
            ->leftJoin('r_form_question_type as secondary_fqt', 'secondary_fqt.fqt_id', 'r_form_questions.fq_secondary_fqt_id')
            ->join('r_form_question_group', 'r_form_question_group.fqg_id', 'r_form_questions.fq_fqg_id')
            ->whereIn('r_form_question_type.fqt_desc', [
                'Ranking, Acceptance',
                'Ranking, Relevance',
                'Ranking, Extent'
            ])
            ->groupBy('r_form_answers.fa_answer', 'r_form_answers.fa_is_secondary_answer', 'r_form_question_type.fqt_desc', 'r_form_questions.fq_desc', 'r_form_question_group.fqg_desc')
            ->orderBy('r_form_answers.created_at', 'desc')
            ->get()->toArray();
        return $this->filterFlatLikertScaleAnswerData($aResult);
    }

    private function filterFlatLikertScaleAnswerData(array $aData)
    {
        $aResult = [];
        foreach ($aData as $aValue) {
            $sQuestionType = (bool) $aValue->secondary_answer ? $aValue->secondary_fqt : $aValue->question_type;
            $aResult[$aValue->question_group][$sQuestionType]['questions'][] = $aValue->question;
            foreach($this->getLikertScaleAnswer($sQuestionType) as $iAnswer => $sAnswer) {
                $aResult[$aValue->question_group][$sQuestionType]['ranking'][$sAnswer][] =+ ((int) $aValue->answer === $iAnswer) ? $aValue->value : 0;
            }
        }
        return $aResult;
    }

    private function getLikertScaleAnswer(string $sQuestionType)
    {
        if ($sQuestionType === 'Ranking, Extent') {
            return self::EXTENT;
        }
        if ($sQuestionType === 'Ranking, Acceptance') {
            return self::RELEVANCE;
        }
        if ($sQuestionType === 'Ranking, Relevance') {
            return self::RELEVANCE;
        }
    }
}
