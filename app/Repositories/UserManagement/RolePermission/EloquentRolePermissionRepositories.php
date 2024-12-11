<?php

namespace App\Repositories\UserManagement\RolePermission;

/**
 * import component
 */

use App\Exceptions\CustomException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

/**
 * import traits
 */

use App\Traits\Response;
use App\Traits\Message;

/**
 * import models
 */

use App\Models\Role;

/**
 * import helpers
 */

use App\Helpers\CheckerHelpers;

/**
 * import interface
 */

use App\Repositories\UserManagement\RolePermission\RolePermissionRepositories;

class EloquentRolePermissionRepositories implements RolePermissionRepositories
{
    use Message, Response;

    private $checkerHelpers;
    private $date;
    private $roleModel;

    public function __construct(
        CheckerHelpers $checkerHelpers,
        Role $roleModel
    ) {
        /**
         * initialize helper
         */
        $this->checkerHelpers = $checkerHelpers;

        /**
         * initialize model
         */
        $this->roleModel = $roleModel;

        /**
         * static value
         */
        $this->date = Carbon::now()->toDateString();
    }

    /**
     * get role permission by id
     */
    public function getRolePermissionById($id)
    {
        try {
            // process get role data
            $getRole = $this->checkerHelpers->roleChecker(['id' => $id]);
            if (is_null($getRole)):
                throw new CustomException(json_encode([$this->outputMessage('not found', 'role'), 404]));
            endif;

            // response data
            $data = $getRole;
            $response = $this->sendResponse(null, 200, $data);
        } catch (CustomException $ex) {
            $ex = json_decode($ex->getMessage());
            $response = $this->sendResponse($ex[0], $ex[1]);
        } catch (\Exception $e) {
            $response = $this->sendResponse($e->getMessage(), 500);
        }
        return $response;
    }

    /**
     * store role permission
     */
    public function storeRolePermission($request)
    {
        DB::beginTransaction();
        try {

            // save role
            $saveRole = $this->roleModel->create($request);
            if (!$saveRole) :
                throw new \Exception($this->outputMessage('unsaved', 'role'));
            endif;

            DB::commit();
            $response = $this->sendResponse($this->outputMessage('saved', 'role'), 201, null);
        } catch (CustomException $ex) {
            $ex = json_decode($ex->getMessage());
            $response = $this->sendResponse($ex[0], $ex[1]);
        } catch (\Exception $e) {
            DB::rollback();
            $response = $this->sendResponse($e->getMessage(), 500);
        }
        return $response;
    }

    /**
     * update role permission
     */
    public function updateRolePermission($id, $request)
    {
        DB::beginTransaction();
        try {

            // check role
            $checkRole = $this->checkerHelpers->roleChecker(['id' => $id]);
            if (is_null($checkRole)):
                throw new CustomException(json_encode([$this->outputMessage('not found', 'role'), 404]));
            endif;

            // update role process
            $updateRole = $this->roleModel->where('id', $id)->update($request);
            if (!$updateRole) :
                throw new \Exception($this->outputMessage('update fail', 'role'));
            endif;

            DB::commit();
            $response = $this->sendResponse($this->outputMessage('updated', 'role'), 201, null);
        } catch (CustomException $ex) {
            $ex = json_decode($ex->getMessage());
            $response = $this->sendResponse($ex[0], $ex[1]);
        } catch (\Exception $e) {
            DB::rollback();
            $response = $this->sendResponse($e->getMessage(), 500);
        }
        return $response;
    }


    /**
     * delete role permission
     */
    public function deleteRolePermission($id)
    {
        DB::beginTransaction();
        try {

            // check role
            $checkRole = $this->checkerHelpers->roleChecker(['id' => $id]);
            if (is_null($checkRole)):
                throw new CustomException(json_encode([$this->outputMessage('not found', 'role'), 404]));
            endif;

            // delete role process
            $updateRole = $this->roleModel->where('id', $id)->delete();
            if (!$updateRole) :
                throw new \Exception($this->outputMessage('undeleted', 'role'));
            endif;

            DB::commit();
            $response = $this->sendResponse($this->outputMessage('deleted', 'role'), 201, null);
        } catch (CustomException $ex) {
            $ex = json_decode($ex->getMessage());
            $response = $this->sendResponse($ex[0], $ex[1]);
        } catch (\Exception $e) {
            DB::rollback();
            $response = $this->sendResponse($e->getMessage(), 500);
        }
        return $response;
    }
}
