<?php

namespace App\Core\API;

use App\Libraries\Common\LogLib;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

/**
 * Class CoreApiRepository
 * @package App\Core\API
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   01/06/2021
 * @version 1.0
 */
abstract class CoreApiRepository
{
    /**
     * Holds the instance of the DB class facade (Query Builder)
     * @var object
     */
    public $oFacade = DB::class;

    /**
     * Holds the table name value from the inherited repository class
     * @var string
     */
    protected $sTableName;

    /**
     * Holds the table name value from the inherited repository class
     * @var string
     */
    protected $sPrimaryKey;

    /**
     * Holds the instance of model from the inherited repository class
     * @var object
     */
    protected $oModel;

    /**
     * Holds the value of created_at column
     * @var string
     */
    public $sCreatedDateColumn = 'created_at';

    /**
     * Holds the value of updated_at column
     * @var string
     */
    public $sUpdatedDateColumn = 'updated_at';

    /**
     * CoreApiRepository constructor.
     * - Initialize DB class facade
     * - Enable query log
     */
    public function __construct()
    {
        ($this->oFacade)::enableQueryLog();
        $this->init();
    }

    /**
     * Initialize Model (DB table)
     */
    public function init()
    {
        $this->oModel = ($this->oFacade)::table($this->sTableName);
    }

    /**
     * Search initializer for the table
     *
     * @param $aWhere
     */
    public function searchParams($aWhere)
    {
        $this->oModel = $this->oModel->where($aWhere);
    }

    /**
     * Pagination initializer for the table
     *
     * @param int $iOffset
     * @param int $iLimit
     */
    public function pagination($iOffset, $iLimit)
    {
        $this->oModel = $this->oModel->skip($iOffset)->take($iLimit);
    }

    /**
     * Method for getting the row count
     *
     * @return array
     */
    public function getCount()
    {
        $aCount = [
            'count' => $this->oModel->count()
        ];
        $this->logInfo($aCount);

        return $aCount;
    }

    /**
     * Method for getting all rows
     *
     * @param string[] $aSelect
     * @return array|mixed
     */
    public function getAll($aSelect = ['*',])
    {
        $aQuery = $this->oModel->get($aSelect)->toArray();
        $this->logInfo($aQuery);

        return $aQuery;
    }

    /**
     * Method for getting a particular row
     *
     * @param string[] $aSelect
     * @return array
     */
    public function get($aSelect = ['*',])
    {
        $aQuery = (array)$this->oModel->first($aSelect);
        $this->logInfo($aQuery);

        return $aQuery;
    }

    /**
     * Method for creating/inserting row
     *
     * @param array $aData
     * @return mixed
     */
    public function createRecord($aData)
    {
        $sSql = $this->oModel->getGrammar()->compileInsert($this->oModel, $aData);
        foreach ($aData as $mData) {
            $sSql = str_replace('?', $mData, $sSql);
        }

        /** Logs before executing query */
        $aProcessInfo[LogLib::MODULE_KEY] = data_get((explode('-', LogLib::$sTraceId)), 0, LogLib::MODULE);
        LogLib::LogAPI($aProcessInfo, $sSql);

        /** Override default timestamp */
        $sDateNow = date('Y-m-d H:i:s');
        $aDateValues = [
            $this->sCreatedDateColumn => $sDateNow,
            $this->sUpdatedDateColumn => $sDateNow
        ];

        /** Execute query */
        $aData = $this->oModel->insertGetId(array_merge($aData, $aDateValues));

        /** Logs after executing query */
        $aProcessInfo[LogLib::REQUEST_TYPE_KEY] = 'Result';
        LogLib::LogAPI($aProcessInfo, $sSql, 'Done executing query', $aData);

        return $aData;
    }

    /**
     * Method for updating/inserting row if row doesn't exist
     *
     * @param array $aFind
     * @param array $aData
     * @return mixed
     */
    public function saveRecord($aFind, $aData)
    {
        $sSql = $this->oModel->getGrammar()->compileUpdate($this->oModel, $aData);
        foreach ($aData as $mData) {
            $sSql = str_replace('?', $mData, $sSql);
        }

        /** Logs before executing query */
        $aProcessInfo[LogLib::MODULE_KEY] = data_get((explode('-', LogLib::$sTraceId)), 0, LogLib::MODULE);
        LogLib::LogAPI($aProcessInfo, $sSql);

        /** Override default timestamp */
        $sDateNow = date('Y-m-d H:i:s');
        $aDateValues = [
            $this->sCreatedDateColumn => $sDateNow,
            $this->sUpdatedDateColumn => $sDateNow
        ];

        /** Execute query */
        $bSave = $this->oModel->updateOrInsert($aFind, array_merge($aData, $aDateValues));

        /** Logs after executing query */
        $aProcessInfo[LogLib::REQUEST_TYPE_KEY] = 'Result';
        LogLib::LogAPI($aProcessInfo, $sSql, 'Done executing query', $aData);

        return $bSave;
    }

    /**
     * Method for updating a particular row
     *
     * @param int $iPrimaryKey
     * @param array $aData
     * @return mixed
     */
    public function updateRecord($iPrimaryKey, $aData)
    {
        $sDateNow = date('Y-m-d H:i:s');
        $aData = array_merge($aData, [$this->sUpdatedDateColumn => $sDateNow]);
        $iUpdate = $this->oModel->where($this->sPrimaryKey, $iPrimaryKey)->update($aData);
        $this->logInfo([$iUpdate]);

        return $iUpdate;
    }

    /**
     * Method for deleting a row
     *
     * @param int $iId
     * @return mixed
     */
    public function deleteRecord($iId)
    {
        $aQuery = $this->oModel->where($this->sPrimaryKey, $iId)->delete();
        $this->logInfo([]);

        return $aQuery;
    }

    /**
     * Method for bulk delete
     *
     * @param string $sColumn
     * @param int $iReferenceId
     * @return mixed
     */
    public function bulkDelete($sColumn, $iReferenceId)
    {
        $aQuery = $this->oModel->where($sColumn, $iReferenceId)->delete();
        $this->logInfo([]);

        return $aQuery;
    }

    /**
     * Method for custom orderBy
     *
     * @param string $sDirection
     * @param string|null $sColumn
     * @return mixed
     */
    public function orderBy($sDirection = 'desc', $sColumn = null)
    {
        /** If column name is not given, primary key will be the default column to be used for ordering */
        $sColumn = $sColumn === null ? $this->sPrimaryKey : $sColumn;

        if ($sDirection === 'desc') { /** Descending */
            $oOrderBy = $this->oModel->latest($sColumn);
        } else if ($sDirection === 'asc') { /** Ascending */
            $oOrderBy = $this->oModel->oldest($sColumn);
        }

        return $oOrderBy;
    }

    /**
     * Method for querying date between
     *
     * @param string $sTable
     * @param array $aWhereDates
     * @param null $sSelectedColumn
     * @return mixed
     */
    public function whereDateBetween($sTable, $aWhereDates, $sSelectedColumn = null)
    {
        $sDateColumn = $sSelectedColumn === null ? $this->sCreatedDateColumn : $sSelectedColumn;
        $sStartDate = "{$aWhereDates['start_date']} 00:00:00";
        $sEndDate = "{$aWhereDates['end_date']} 00:00:00";
        $aDateBetween = [$sStartDate, $sEndDate];
        $sSelectedTable = "{$sTable}.{$sDateColumn}";

        return $this->oModel->whereBetween($sSelectedTable, $aDateBetween);
    }

    /**
     * Method for querying where in
     *
     * @param string $sColumn
     * @param array $aValues
     * @return mixed
     */
    public function whereIn($sColumn, $aValues)
    {
        return $this->oModel->whereIn($sColumn, $aValues);
    }

    /**
     * Method for encrypting values
     *  Cipher Algo - AES-128-CBC
     *  Hash Algo - sha256
     *
     * @param array $aValues
     * @param array $aEncryptedKeys
     * @return mixed
     */
    public function encryptValues($aValues, $aEncryptedKeys)
    {
        $aEncryptedValues = array_intersect_key($aValues, array_flip($aEncryptedKeys));
        foreach ($aEncryptedValues as $mKey => $mValue) {
            $aValues[$mKey] = Crypt::encrypt($mValue);
        }

        return $aValues;
    }

    /**
     * Method for decrypting values
     *
     * @param array $aMultipleValues
     * @param array $aEncryptedKeys
     * @return array
     */
    public function decryptValues($aMultipleValues, $aEncryptedKeys)
    {
        $aDecryptedValues = [];
        foreach ($aMultipleValues as $aValues) {
            $aEncryptedValues = array_intersect_key($aValues, array_flip($aEncryptedKeys));
            foreach ($aEncryptedValues as $mKey => $mValue) {
                try {
                    $aValues[$mKey] = Crypt::decrypt($mValue);
                } catch (DecryptException $e) {
                    $aValues[$mKey] = $mValue;
                }
            }
            array_push($aDecryptedValues, $aValues);
        }

        return $aDecryptedValues;
    }

    /**
     * Method for custom logging of query-based processes
     *
     * @param array $aData
     */
    private function logInfo($aData)
    {
        $aQueryLog = data_get(($this->oFacade)::getQueryLog(), 0, []);
        $sSql = data_get($aQueryLog, 'query', '');
        $aBindings = data_get($aQueryLog, 'bindings', '');

        /** Replace every '?' of the SQL string in each binding */
        foreach ($aBindings as $sBinding) {
            $sStringToReplace = '/' . preg_quote('?', '/') . '/';
            $sSql = preg_replace($sStringToReplace, $sBinding, $sSql, 1);
        }

        /** Get the module of the process */
        $sModule = data_get((explode('-', LogLib::$sTraceId)), 0, LogLib::MODULE);
        $aProcessInfo = [LogLib::MODULE_KEY => $sModule];

        /** Logs before executing query */
        LogLib::LogAPI($aProcessInfo, $sSql);

        /** Logs after executing query */
        $aProcessInfo[LogLib::REQUEST_TYPE_KEY] = 'Result';
        LogLib::LogAPI($aProcessInfo, $sSql, 'Done executing query', $aData);
    }
}

