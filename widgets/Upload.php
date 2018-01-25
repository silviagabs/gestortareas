<?php

namespace app\widgets;

use Yii;
use app\assets\UploadAssets;

class Upload extends \yii\base\Widget {
    public $form;
    public $model;
    public $nombre;

    public function init() {
        UploadAssets::register($this->getView());
        parent::init();
    }

    public function run() {
        return $this->render("Upload/upload",[
            "form"=>$this->form,
            "model"=>$this->model,
            "nombre"=>$this->nombre,
        ]);
    }

}
