<?php

namespace App\Core\API;

use App\Libraries\API\ArrayLib;
use App\Libraries\API\WhereLib;
use Laravel\Lumen\Routing\Controller;

/**
 * Class CoreApiController
 * @package App\Core\API
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   01/06/2021
 * @version 1.0
 */
abstract class CoreApiController extends Controller
{
    /**
     * Holds the instance of the repository
     * @var $oRepository
     */
    protected $oRepository;

    /**
     * Holds the instance of Illuminate\Request\Http
     * @var $oRequest
     */
    protected $oRequest;

    /**
     * Retrieve the count data from the database
     *
     * @param string $sTraceId
     * @return mixed
     */
    public function getCountData($sTraceId)
    {
        $aWhere = $this->getFilter();
        $aWhere = WhereLib::makeArray($aWhere);
        $this->oRepository->searchParams($aWhere);

        $aSelect = $this->oRepository->aSearch;
        array_unshift($aSelect, $this->oRepository->sPrimaryKey);

        return $this->oRepository->getCount($sTraceId);
    }

    /**
     * Retrieve all rows from the database
     * - Without Pagination
     *
     * @param array $aSearch
     * @param string $sTraceId
     * @return mixed
     */
    public function getAllData($aSearch, $sTraceId)
    {
        $aWhere = $this->oRequest->only($aSearch);
        $aWhere = WhereLib::makeArray($aWhere);
        $this->oRepository->searchParams($aWhere);

        $aSelect = array_merge($this->oRepository->aForeignKeys, $this->oRepository->aSearch);
        array_unshift($aSelect, $this->oRepository->sPrimaryKey);

        return $this->oRepository->getAll($aSelect, $sTraceId);
    }

    /**
     * Retrieve multiple rows from the database
     * - With Pagination
     *
     * @param int $iOffset
     * @param int $iLimit
     * @param string $sTraceId
     * @return mixed
     */
    public function getData($iOffset, $iLimit, $sTraceId)
    {
        $aWhere = $this->getFilter();
        $aWhere = WhereLib::makeArray($aWhere);
        $this->oRepository->searchParams($aWhere);
        $this->oRepository->pagination($iOffset, $iLimit);

        $aSelect = $this->oRepository->aSearch;
        array_unshift($aSelect, $this->oRepository->sPrimaryKey);

        return $this->oRepository->getAll($aSelect, $sTraceId);
    }

    /**
     * Inserts data to the database
     *
     * @param array $aRules
     * @param array $aSearch
     * @param string $sTraceId
     * @return mixed
     * @throws \Illuminate\Validation\ValidationException
     */
    public function createData($aRules, $aSearch, $sTraceId)
    {
        $aRequest = $this->validate($this->oRequest, $aRules);
        $aData = ArrayLib::filterKeys($aRequest, $aSearch);

        return $this->oRepository->createRecord($aData, $sTraceId);
    }

    /**
     * Updates data in the database
     *
     * @param int $iId
     * @param array $aRules
     * @param array $aSearch
     * @return mixed
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateData($iId, $aRules, $aSearch)
    {
        $aRequest = $this->validate($this->oRequest, $aRules);
        $aData = ArrayLib::filterKeys($aRequest, $aSearch);

        return $this->oRepository->updateRecord($iId, $aData);
    }

    /**
     * Deletes data in the database
     *
     * @param int $iId
     * @return mixed
     */
    public function deleteData($iId)
    {
        return $this->oRepository->deleteRecord($iId);
    }

    /**
     * Filters date columns
     */
    public function getFilter()
    {
        $aRequest = $this->oRequest->all();
        $sFilterType = array_key_exists('filter_type', $aRequest) === true ? $aRequest['filter_type'] : '';
        $aFilter = [];
        foreach ($this->oRepository->aSearch as $sKey) {
            if ($sKey === $this->oRepository->sTableName . '.updated_at' && array_key_exists('updated_at', $aRequest)) {
                $aFilter[$sKey . $sFilterType] = $this->addWildCard($aRequest['updated_at']);
            }

            if ($sKey === $this->oRepository->sTableName . '.created_at' && array_key_exists('created_at', $aRequest)) {
                $aFilter[$sKey . $sFilterType] = $this->addWildCard($aRequest['created_at']);
            }

            if (array_key_exists($sKey, $aRequest)) {
                $aFilter[$this->oRepository->sTableName . '.' . $sKey . $sFilterType] = $this->addWildCard($aRequest[$sKey]);
            }
        }
    }

    /**
     * Adds wildcard value if the given value is empty/null
     *
     * @param mixed $mValue
     * @return string
     */
    private function addWildCard($mValue)
    {
        $sFilterType = $this->oRequest->get('filter_type', '');
        if ($sFilterType === '-like') {
            return '%' . $mValue . '%';
        }

        return $mValue;
    }
}
