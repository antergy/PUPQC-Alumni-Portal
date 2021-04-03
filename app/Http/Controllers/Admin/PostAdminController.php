<?php

namespace App\Http\Controllers\Admin;

use App\Constants\AppConstants;
use App\Http\Controllers\Controller;
use App\Http\Services\Admin\PostManagementService;
use App\Libraries\Common\LogLib;
use App\Libraries\Common\ResponseLib;
use Illuminate\Http\Request;

/**
 * Class PostAdminController
 * @package App\Http\Controllers\Admin
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   01/25/2021
 * @version 1.0
 */
class PostAdminController extends Controller
{
    /**
     * Holds the instance of Illuminate\Http\Request
     * @var Request
     */
    public $oRequest;

    /**
     * Holds the instance of the post management service
     * @var PostManagementService
     */
    public $oPostManageService;

    /**
     * PostAdminController constructor.
     * @param Request $oRequest
     * @param PostManagementService $oPostManageService
     */
    public function __construct(Request $oRequest, PostManagementService $oPostManageService)
    {
        $this->oRequest = $oRequest;
        $this->oPostManageService = $oPostManageService;
        LogLib::initTraceId('post_manage');
    }

    /**
     * Retrieves posts
     *
     * @return array
     */
    public function readPosts()
    {
        try {
            /** Prepare the parameters */
            $aParams = $this->oRequest->all();

            /** Execute request */
            $mResult = $this->oPostManageService->getPosts($aParams);
            return ResponseLib::formatSuccessResponse($mResult[AppConstants::DATA], $mResult[AppConstants::MESSAGE]);
        } catch (\Throwable $oException) {
            return ResponseLib::formatErrorResponse($oException);
        }
    }

    /**
     * Retrieves a more detailed post (single)
     *
     * @return array
     */
    public function getDetailedPost()
    {
        try {
            /** Validate post id */
            $aPostId = $this->oPostManageService->getPostId($this->oRequest);
            if ($aPostId[AppConstants::DATA] === false) {
                $sMessage = $aPostId[AppConstants::MESSAGE];
                $mData = $aPostId[AppConstants::DATA];
            } else {
                /** Executes the request */
                $mResult = $this->oPostManageService->getDetailedPost($aPostId[AppConstants::DATA]);
                $mData = $mResult[AppConstants::DATA];
                $sMessage = $mResult[AppConstants::MESSAGE];
            }

            return ResponseLib::formatSuccessResponse($mData, $sMessage);
        } catch (\Throwable $oException) {
            return ResponseLib::formatErrorResponse($oException);
        }
    }

    /**
     * Creates a post
     *
     * @return array
     */
    public function createPost()
    {
        try {
            /** Prepares the parameters */
            $aParams = $this->oRequest->all();

            /** Executes the request */
            $mResult = $this->oPostManageService->createPost($aParams);

            return ResponseLib::formatSuccessResponse($mResult[AppConstants::DATA], $mResult[AppConstants::MESSAGE]);
        } catch (\Throwable $oException) {
            return ResponseLib::formatErrorResponse($oException);
        }
    }

    /**
     * Updates a post
     *
     * @return array
     */
    public function updatePost()
    {
        try {
            /** Prepares the parameters and validates the post id */
            $aParams = $this->oRequest->all();
            $aPostId = $this->oPostManageService->getPostId($this->oRequest);
            if ($aPostId[AppConstants::DATA] === false) {
                $sMessage = $aPostId[AppConstants::MESSAGE];
                $mData = $aPostId[AppConstants::DATA];
            } else {
                /** Executes the request */
                $mResult = $this->oPostManageService->updatePost($aParams);
                $mData = $mResult[AppConstants::DATA];
                $sMessage = $mResult[AppConstants::MESSAGE];
            }

            return ResponseLib::formatSuccessResponse($mData, $sMessage);
        } catch (\Throwable $oException) {
            return ResponseLib::formatErrorResponse($oException);
        }
    }

    /**
     * Deletes a post
     *
     * @return array
     */
    public function deletePost()
    {
        try {
            /** Prepares the parameters and validates the post id */
            $aParams = $this->oRequest->all();
            $aPostId = $this->oPostManageService->getPostId($this->oRequest);
            if ($aPostId[AppConstants::DATA] === false) {
                $sMessage = $aPostId[AppConstants::MESSAGE];
                $mData = $aPostId[AppConstants::DATA];
            } else {
                /** Executes the request */
                $mResult = $this->oPostManageService->deletePost($aParams);
                $mData = $mResult[AppConstants::DATA];
                $sMessage = $mResult[AppConstants::MESSAGE];
            }

            return ResponseLib::formatSuccessResponse($mData, $sMessage);
        } catch (\Throwable $oException) {
            return ResponseLib::formatErrorResponse($oException);
        }
    }

    /**
     * Retrieves the post's likes
     *
     * @return array
     */
    public function getLikes()
    {
        try {
            /** Validate post id */
            $aPostId = $this->oPostManageService->getPostId($this->oRequest, 'lk_post_id');
            if ($aPostId[AppConstants::DATA] === false) {
                $sMessage = $aPostId[AppConstants::MESSAGE];
                $mData = $aPostId[AppConstants::DATA];
            } else {
                /** Executes the request */
                $mResult = $this->oPostManageService->retrieveLikes($aPostId[AppConstants::DATA]);
                $mData = $mResult[AppConstants::DATA];
                $sMessage = $mResult[AppConstants::MESSAGE];
            }

            return ResponseLib::formatSuccessResponse($mData, $sMessage);
        } catch (\Throwable $oException) {
            return ResponseLib::formatErrorResponse($oException);
        }
    }

    /**
     * Manages the actions for likes
     * - Includes creating and updating the status
     *
     * @return array
     */
    public function manageLikes()
    {
        try {
            /** Prepares the parameters and validates post id */
            $aParams = $this->oRequest->all();
            $aPostId = $this->oPostManageService->getPostId($this->oRequest, 'lk_post_id');
            if ($aPostId[AppConstants::DATA] === false) {
                $sMessage = $aPostId[AppConstants::MESSAGE];
                $mData = $aPostId[AppConstants::DATA];
            } else {
                /** Executes the request */
                $mResult = $this->oPostManageService->manageLikes($aParams);
                $mData = $mResult[AppConstants::DATA];
                $sMessage = $mResult[AppConstants::MESSAGE];
            }

            return ResponseLib::formatSuccessResponse($mData, $sMessage);
        } catch (\Throwable $oException) {
            return ResponseLib::formatErrorResponse($oException);
        }
    }

    /**
     * Retrieves the post's comments
     *
     * @return array
     */
    public function getComments()
    {
        try {
            /** Validates the post id */
            $aPostId = $this->oPostManageService->getPostId($this->oRequest, 'cm_post_id');
            if ($aPostId[AppConstants::DATA] === false) {
                $sMessage = $aPostId[AppConstants::MESSAGE];
                $mData = $aPostId[AppConstants::DATA];
            } else {
                /** Executes the request */
                $mResult = $this->oPostManageService->retrieveComments($aPostId[AppConstants::DATA]);
                $mData = $mResult[AppConstants::DATA];
                $sMessage = $mResult[AppConstants::MESSAGE];
            }

            return ResponseLib::formatSuccessResponse($mData, $sMessage);
        } catch (\Throwable $oException) {
            return ResponseLib::formatErrorResponse($oException);
        }
    }

    /**
     * Manages the actions for comments
     * - Includes creating, updating and deleting
     *
     * @return array
     */
    public function manageComments()
    {
        try {
            /** Prepares the parameters, action to be used, and validates the post id */
            $aParams = $this->oRequest->all();
            $sAction = $this->getAction();
            $aPostId = $this->oPostManageService->getPostId($this->oRequest, 'cm_post_id');
            if ($aPostId[AppConstants::DATA] === false) {
                $sMessage = $aPostId[AppConstants::MESSAGE];
                $mData = $aPostId[AppConstants::DATA];
            } else {
                /** Executes the request based on action */
                $mResult = $this->oPostManageService->manageComments($aParams, $sAction);
                $mData = $mResult[AppConstants::DATA];
                $sMessage = $mResult[AppConstants::MESSAGE];
            }

            return ResponseLib::formatSuccessResponse($mData, $sMessage);
        } catch (\Throwable $oException) {
            return ResponseLib::formatErrorResponse($oException);
        }
    }
}
