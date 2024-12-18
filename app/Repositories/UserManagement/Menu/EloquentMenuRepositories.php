<?php

namespace App\Repositories\UserManagement\Menu;

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

use App\Models\Menu;

/**
 * import helpers
 */

use App\Helpers\CheckerHelpers;

/**
 * import interface
 */

use App\Repositories\UserManagement\Menu\MenuRepositories;

class EloquentMenuRepositories implements MenuRepositories
{
    use Message, Response;

    private $checkerHelpers;
    private $date;
    private $menuModel;
    private $menuModelR1;

    public function __construct(
        CheckerHelpers $checkerHelpers,
        Menu $menuModel
    ) {
        /**
         * initialize helper
         */
        $this->checkerHelpers = $checkerHelpers;

        /**
         * initialize model
         */
        $this->menuModel = $menuModel;
        $this->menuModelR1 = DB::table('menus as r1');

        /**
         * static value
         */
        $this->date = Carbon::now()->toDateString();
    }

    /**
     * menu listing
     */
    public function listMenu()
    {
        try {
            // process get user data
            $data = $this->menuModelR1->select(
                'r1.menu_name as menu_name',
                'r2.menu_name as parent',
                'r1.route',
                'r1.id',
                'r1.parent_menu_id',
            )
                ->leftJoin('menus as r2', 'r1.parent_menu_id', '=', 'r2.id')
                ->orderBy('r1.id', 'asc')
                ->paginate(10);
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
     * get menu by id
     */
    public function getMenuById($id)
    {
        try {
            // process get menu data
            $getMenu = $this->checkerHelpers->menuChecker(['r1.id' => $id]);
            if (is_null($getMenu)):
                throw new CustomException(json_encode([$this->outputMessage('not found', 'menu'), 404]));
            endif;

            // response data
            $data = $getMenu;
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
     * store menu
     */
    public function storeMenu($request)
    {
        DB::beginTransaction();
        try {

            // save menu
            $saveMenu = $this->menuModel->create($request);
            if (!$saveMenu) :
                throw new \Exception($this->outputMessage('unsaved', 'menu'));
            endif;

            DB::commit();
            $response = $this->sendResponse($this->outputMessage('saved', 'menu'), 201, null);
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
     * update menu
     */
    public function updateMenu($id, $request)
    {
        DB::beginTransaction();
        try {

            // check menu
            $checkMenu = $this->checkerHelpers->menuChecker(['r1.id' => $id]);
            if (is_null($checkMenu)):
                throw new CustomException(json_encode([$this->outputMessage('not found', 'menu'), 404]));
            endif;

            // update menu process
            $updateMenu = $this->menuModel->where('id', $id)->update($request);
            if (!$updateMenu) :
                throw new \Exception($this->outputMessage('update fail', 'menu'));
            endif;

            DB::commit();
            $response = $this->sendResponse($this->outputMessage('updated', 'menu'), 201, null);
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
     * delete menu
     */
    public function deleteMenu($id)
    {
        DB::beginTransaction();
        try {

            // check menu
            $checkMenu = $this->checkerHelpers->menuChecker(['r1.id' => $id]);
            if (is_null($checkMenu)):
                throw new CustomException(json_encode([$this->outputMessage('not found', 'menu'), 404]));
            endif;

            // delete menu process
            $updateMenu = $this->menuModel->where('id', $id)->delete();
            if (!$updateMenu) :
                throw new \Exception($this->outputMessage('undeleted', 'menu'));
            endif;

            DB::commit();
            $response = $this->sendResponse($this->outputMessage('deleted', 'menu'), 201, null);
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
