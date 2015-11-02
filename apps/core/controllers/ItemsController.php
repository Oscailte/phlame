<?php
namespace Phlame\Core\Controllers;

use Phlame\Core\Models\Items;
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class ItemsController extends ControllerBase
{

    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for items
     */
    public function searchAction()
    {

        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "Phlame\Core\Models\Items", $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "id";

        $items = Items::find($parameters);
        if (count($items) == 0) {
            $this->flash->notice("The search did not find any items");

            return $this->dispatcher->forward(array(
                "controller" => "items",
                "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $items,
            "limit"=> 10,
            "page" => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Displays the creation form
     */
    public function newAction()
    {

    }

    /**
     * Edits a item
     *
     * @param string $id
     */
    public function editAction($id)
    {

        if (!$this->request->isPost()) {

            $item = Items::findFirstByid($id);
            if (!$item) {
                $this->flash->error("item was not found");

                return $this->dispatcher->forward(array(
                    "controller" => "items",
                    "action" => "index"
                ));
            }

            $this->view->id = $item->id;

            $this->tag->setDefault("id", $item->id);
            $this->tag->setDefault("type_id", $item->type_id);
            
        }
    }

    /**
     * Creates a new item
     */
    public function createAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "items",
                "action" => "index"
            ));
        }

        $item = new Items();

        $item->type_id = $this->request->getPost("type_id");
        

        if (!$item->save()) {
            foreach ($item->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "items",
                "action" => "new"
            ));
        }

        $this->flash->success("item was created successfully");

        return $this->dispatcher->forward(array(
            "controller" => "items",
            "action" => "index"
        ));

    }

    /**
     * Saves a item edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "items",
                "action" => "index"
            ));
        }

        $id = $this->request->getPost("id");

        $item = Items::findFirstByid($id);
        if (!$item) {
            $this->flash->error("item does not exist " . $id);

            return $this->dispatcher->forward(array(
                "controller" => "items",
                "action" => "index"
            ));
        }

        $item->type_id = $this->request->getPost("type_id");
        

        if (!$item->save()) {

            foreach ($item->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "items",
                "action" => "edit",
                "params" => array($item->id)
            ));
        }

        $this->flash->success("item was updated successfully");

        return $this->dispatcher->forward(array(
            "controller" => "items",
            "action" => "index"
        ));

    }

    /**
     * Deletes a item
     *
     * @param string $id
     */
    public function deleteAction($id)
    {

        $item = Items::findFirstByid($id);
        if (!$item) {
            $this->flash->error("item was not found");

            return $this->dispatcher->forward(array(
                "controller" => "items",
                "action" => "index"
            ));
        }

        if (!$item->delete()) {

            foreach ($item->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "items",
                "action" => "search"
            ));
        }

        $this->flash->success("item was deleted successfully");

        return $this->dispatcher->forward(array(
            "controller" => "items",
            "action" => "index"
        ));
    }

}
