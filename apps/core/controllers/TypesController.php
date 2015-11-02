<?php
namespace Phlame\Core\Controllers;

use Phlame\Core\Models\Types;
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class TypesController extends ControllerBase
{

    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for types
     */
    public function searchAction()
    {

        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "Phlame\Core\Models\Types", $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "id";

        $types = Types::find($parameters);
        if (count($types) == 0) {
            $this->flash->notice("The search did not find any types");

            return $this->dispatcher->forward(array(
                "controller" => "types",
                "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $types,
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
     * Edits a type
     *
     * @param string $id
     */
    public function editAction($id)
    {

        if (!$this->request->isPost()) {

            $type = Types::findFirstByid($id);
            if (!$type) {
                $this->flash->error("type was not found");

                return $this->dispatcher->forward(array(
                    "controller" => "types",
                    "action" => "index"
                ));
            }

            $this->view->id = $type->id;

            $this->tag->setDefault("id", $type->id);
            $this->tag->setDefault("name", $type->name);
            
        }
    }

    /**
     * Creates a new type
     */
    public function createAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "types",
                "action" => "index"
            ));
        }

        $type = new Types();

        $type->name = $this->request->getPost("name");
        

        if (!$type->save()) {
            foreach ($type->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "types",
                "action" => "new"
            ));
        }

        $this->flash->success("type was created successfully");

        return $this->dispatcher->forward(array(
            "controller" => "types",
            "action" => "index"
        ));

    }

    /**
     * Saves a type edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "types",
                "action" => "index"
            ));
        }

        $id = $this->request->getPost("id");

        $type = Types::findFirstByid($id);
        if (!$type) {
            $this->flash->error("type does not exist " . $id);

            return $this->dispatcher->forward(array(
                "controller" => "types",
                "action" => "index"
            ));
        }

        $type->name = $this->request->getPost("name");
        

        if (!$type->save()) {

            foreach ($type->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "types",
                "action" => "edit",
                "params" => array($type->id)
            ));
        }

        $this->flash->success("type was updated successfully");

        return $this->dispatcher->forward(array(
            "controller" => "types",
            "action" => "index"
        ));

    }

    /**
     * Deletes a type
     *
     * @param string $id
     */
    public function deleteAction($id)
    {

        $type = Types::findFirstByid($id);
        if (!$type) {
            $this->flash->error("type was not found");

            return $this->dispatcher->forward(array(
                "controller" => "types",
                "action" => "index"
            ));
        }

        if (!$type->delete()) {

            foreach ($type->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "types",
                "action" => "search"
            ));
        }

        $this->flash->success("type was deleted successfully");

        return $this->dispatcher->forward(array(
            "controller" => "types",
            "action" => "index"
        ));
    }

}
