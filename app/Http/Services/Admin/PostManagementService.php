<?php

namespace App\Http\Services\Admin;

use App\Constants\AppConstants;
use App\Core\Admin\CoreAdminService;
use App\Http\Validators\CommentValidator;
use App\Http\Validators\LikeValidator;
use App\Http\Validators\PostValidator;

/**
 * Class PostManagementService
 * @package App\Http\Services\Admin
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   01/25/2021
 * @version 1.0
 */
class PostManagementService extends CoreAdminService
{
    /**
     * Constants for posts api module
     */
    const POSTS_API_MODULE = 'posts';

    /**
     * Constants for likes api module
     */
    const LIKES_API_MODULE = 'likes';

    /**
     * Constants for comments api module
     */
    const COMMENTS_API_MODULE = 'comments';

    /**
     * Gets the post id from the request parameters and validates it
     *
     * @param object $oRequest
     * @param string $sCustomKey
     * @return array
     */
    public function getPostId($oRequest, $sCustomKey = 'p_id')
    {
        /** Gets the post id from the request params */
        $iPostId = $oRequest->input($sCustomKey, null);
        if ($iPostId === null) {
            $sMessage = 'There is no post specified';
            $mData = false;
        } else {
            /** Check if the post id exists in the db */
            $mResult = $this->getDetailedPost($iPostId);
            $sMessage = $mResult;
            $mData = $mResult[AppConstants::DATA] !== false ? $iPostId : false;
        }

        return [
            AppConstants::DATA    => $mData,
            AppConstants::MESSAGE => $sMessage
        ];
    }

    /**
     * Retrieves post records
     *
     * @param array $aParams
     * @return array|mixed
     */
    public function getPosts(array $aParams)
    {
        /** Build the request url and executes it */
        $sApiRoute = sprintf('/%s/%s/read', self::API_VERSION, self::POSTS_API_MODULE);
        $aPosts = $this->sendInternalApiRequest($sApiRoute, 'GET', $aParams);

        /** Include the post's like(s) count */
        $aPostsWithLikeCount = [];
        foreach ($aPosts[AppConstants::DATA] as $aPost) {
            $iCount = data_get($this->getLikeCount($aPost['p_id']), 'count');
            $aPostWithCount = array_merge($aPost, ['like_count' => $iCount]);
            array_push($aPostsWithLikeCount, $aPostWithCount);
        }

        /** Replace the data value of the posts variable */
        $aPosts[AppConstants::DATA] = $aPostsWithLikeCount;

        return $aPosts;
    }

    /**
     * Retrieves the details of a specific post
     *
     * @param int $iPostId
     * @return array
     */
    public function getDetailedPost(int $iPostId)
    {
        /** Assign the post id as parameter, build the request url and executes it */
        $aParams = ['p_id' => $iPostId];
        $sApiRoute = sprintf('/%s/%s/read', self::API_VERSION, self::POSTS_API_MODULE);
        $mResult = $this->sendInternalApiRequest($sApiRoute, 'GET', $aParams);

        /** Check if the requests returns a value */
        if (empty($mResult[AppConstants::DATA]) === true) {
            $sMessage = "The post specified doesn't exists";
            $mData = false;
        } else {
            $sMessage = $mResult[AppConstants::MESSAGE];
            $mData = $mResult[AppConstants::DATA];
        }

        return [
            AppConstants::DATA    => $mData,
            AppConstants::MESSAGE => $sMessage
        ];
    }

    /**
     * Creates a post record
     *
     * @param array $aParams
     * @return array|bool[]|mixed
     */
    public function createPost(array $aParams)
    {
        /** Validates parameters */
        $aValidationResult = PostValidator::validate($aParams);
        if ($aValidationResult[AppConstants::DATA] === false) {
            $mResult = $aValidationResult;
        } else {
            /** Build the request url and executes it */
            $sApiRoute = sprintf('/%s/%s/create', self::API_VERSION, self::POSTS_API_MODULE);
            $mResult = $this->sendInternalApiRequest($sApiRoute, 'POST', $aParams);
        }

        return $mResult;
    }

    /**
     * Updates a post record
     *
     * @param array $aParams
     * @return array|bool[]
     */
    public function updatePost(array $aParams)
    {
        /** Check if the post id given exists */
        $aPostExistCheck = $this->getDetailedPost($aParams['p_id']);
        if (!empty($aPostExistCheck[AppConstants::DATA]) === true) {
            $aValidationResult = PostValidator::validate($aParams);
            if ($aValidationResult[AppConstants::DATA] === false) {
                $mResult = $aValidationResult;
            } else {
                /** Build request url then executes it */
                $sApiRoute = sprintf('/%s/%s/update', self::API_VERSION, self::POSTS_API_MODULE);
                $mResult = $this->sendInternalApiRequest($sApiRoute, 'POST', $aParams);
            }
        } else {
            /** Returning value if the post id doesn't exist */
            $mResult = [
                AppConstants::DATA    => false,
                AppConstants::MESSAGE => "The post specified doesn't exists"
            ];
        }

        return $mResult;
    }

    /**
     * Deletes a post record
     *
     * @param array $aParams
     * @return array|mixed
     */
    public function deletePost(array $aParams)
    {
        /** Check if the post id given exists */
        $iPostId = (int)$aParams['p_id'];
        $aPostExistCheck = $this->getDetailedPost($iPostId);
        if (!empty($aPostExistCheck[AppConstants::DATA]) === true) {
            /** Delete all comment records from the given post id */
            $sDeleteCommentsApiRoute = sprintf('/%s/posts/%s/deleteByPost', self::API_VERSION, self::COMMENTS_API_MODULE);
            $this->sendInternalApiRequest($sDeleteCommentsApiRoute, 'POST', ['cm_post_id' => $iPostId]);

            /** Delete all like records from the given post id */
            $sDeleteLikesApiRoute = sprintf('/%s/posts/%s/deleteByPost', self::API_VERSION, self::LIKES_API_MODULE);
            $this->sendInternalApiRequest($sDeleteLikesApiRoute, 'POST', ['lk_post_id' => $iPostId]);

            /** Delete the post */
            $sDeletePostApiRoute = sprintf('/%s/%s/delete', self::API_VERSION, self::POSTS_API_MODULE);
            $mResult = $this->sendInternalApiRequest($sDeletePostApiRoute, 'POST', ['p_id' => $iPostId]);
        } else {
            /** Returning value if the post id doesn't exist */
            $mResult = [
                AppConstants::DATA    => false,
                AppConstants::MESSAGE => "The post specified doesn't exists"
            ];
        }

        return $mResult;
    }

    /**
     * Retrieves the likes count of a particular post
     *
     * @param int $iPostId
     * @return array|mixed
     */
    public function getLikeCount(int $iPostId)
    {
        /** Build request url then executes it */
        $sApiRoute = sprintf('/%s/posts/%s/count', self::API_VERSION, self::LIKES_API_MODULE);
        $mResult = $this->sendInternalApiRequest($sApiRoute, 'GET', ['lk_post_id' => $iPostId]);

        return data_get($mResult, AppConstants::DATA);
    }

    /**
     * Retrieves the like records of a particular post
     *
     * @param int $iPostId
     * @return array|mixed
     */
    public function retrieveLikes(int $iPostId)
    {
        /** Build request url then executes it */
        $sApiRoute = sprintf('/%s/posts/%s/read', self::API_VERSION, self::LIKES_API_MODULE);
        return $this->sendInternalApiRequest($sApiRoute, 'GET', ['lk_post_id' => $iPostId]);
    }

    /**
     * Manages a post's like records
     * - Includes creating and updating
     *
     * @param array $aParams
     * @return array|bool[]|mixed
     */
    public function manageLikes(array $aParams)
    {
        /** Validates the parameters */
        $aValidationResult = LikeValidator::validate($aParams);
        if ($aValidationResult[AppConstants::DATA] === false) {
            $mResult = $aValidationResult;
        } else {
            /** Determine the request action  */
            $iLkStatus = data_get($aParams, 'lk_status', null);
            $sAction = $iLkStatus === null ? 'create' : 'update';
            if ($sAction === 'update') {
                $aParams['lk_status'] = (int)$aParams['lk_status'] === 1 ? 0 : 1;
                unset($aParams['lk_post_id']);
                unset($aParams['lk_acc_id']);
            }
            /** Build request url then executes it */
            $sLikeApiRoute = sprintf('/%s/posts/%s/%s', self::API_VERSION, self::LIKES_API_MODULE, $sAction);
            $mResult = $this->sendInternalApiRequest($sLikeApiRoute, 'POST', $aParams);
        }

        return $mResult;
    }

    /**
     * Retrieves the comment records of a particular post
     *
     * @param int $iPostId
     * @return array|mixed
     */
    public function retrieveComments($iPostId)
    {
        /** Build request url then executes it */
        $sApiRoute = sprintf('/%s/posts/%s/read', self::API_VERSION, self::COMMENTS_API_MODULE);
        return $this->sendInternalApiRequest($sApiRoute, 'GET', ['cm_post_id' => $iPostId]);
    }

    /**
     * Manages a post's like records
     * - Includes creating, updating, and deleting
     *
     * @param array $aParams
     * @param string $sAction
     * @return array|bool[]|mixed
     */
    public function manageComments(array $aParams, string $sAction)
    {
        /** Determine the request action  */
        if ($sAction === 'create' || 'update') {
            $aValidationResult = CommentValidator::validate($aParams);
            if ($aValidationResult[AppConstants::DATA] === false) {
                return $aValidationResult;
            }
        }
        /** Build request url then executes it */
        $sApiRoute = sprintf('/%s/posts/%s/%s', self::API_VERSION, self::COMMENTS_API_MODULE, $sAction);
        $mResult = $this->sendInternalApiRequest($sApiRoute, 'POST', $aParams);

        return $mResult;
    }
}
