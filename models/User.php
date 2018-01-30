<?php

namespace app\models;

use yii\captcha\Captcha;
use yii\captcha\CaptchaAction;
use Yii;

class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface {

    public $password_repeat;
    public $codigo;

    public static function tableName() {
        return 'usuarios';
    }

    public function scenarios() {
        //colocar los campos que necesito que pase en la asignacion masiva
        return [
            'crear'=>['password_repeat', 'password', 'nombre', 'apellidos', 'email', 'username', 'codigo'],
            'actualizar' => ['password', 'nombre', 'email', 'username', 'codigo'],
            'admin'=>['password', 'nombre', 'apellidos', 'email', 'username', 'codigo', 'activo'],
        ];
    }

    public function rules() {
        return [
            [['nombre', 'password'], 'string', 'max' => 255,'on' => 'crear'],
            [['nombre', 'password', 'password_repeat', 'email', 'username'], 'required', 'message' => 'El campo {attribute} es obligatorio','on' => 'crear'],
            // que el usuario no exista
            [['username', 'email'], 'unique', 'message' => 'El {attribute} ya existe en el sistema','on' => 'crear'],
            ['password', 'string', 'min' => 4, 'message' => 'la contraseña debe tener al menos 6 caracteres','on' => 'crear'],
            ['email', 'email', 'message' => 'Escribe un correo correctamente','on' => 'crear'],
            //comparacion de contraseñas
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'operator' => '==', 'message' => 'Las contraseñas deben coincidir', 'on' => 'crear'],
            // validacion de captcha
            //['codigo', 'captcha', 'message' => 'No coincide el codigo mostrado'], // esto funcionaria correctamente sin AJAX
            //Con AJAX existe un bug lo corregimos con una funcion 
            ['codigo', 'codeVerify', 'on' => 'crear'],
            ['codigo', 'required', 'message' => 'Debes escribir algo en los codigos', 'on' => 'crear'],
            
            //[['password_repeat', 'password', 'nombre', 'email', 'username', 'codigo'], 'safe'],
        ];
    }

    public function attributeLabels() {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'password' => 'Contraseña',
            'password_repeat' => 'Repite la contraseña',
            'codigo' => 'Escribe los codigos que ves',
        ];
    }

    public function codeVerify($attribute) {
        /* nombre de la accion del controlador */
        $captcha_validate = new \yii\captcha\CaptchaAction('captcha', Yii::$app->controller);


        if ($this->$attribute) {
            $code = $captcha_validate->getVerifyCode();
            if ($this->$attribute != $code) {
                $this->addError($attribute, 'Ese codigo de verificacion no es correcto');
            }
        }
    }

    public static function findIdentity($id) {
        return static::findOne(['id' => $id]);
    }

    public static function findByUsername($username) {
        return static::findOne(['username' => $username]);
    }

    /**
     * @inheritdoc
     */
    public function getId() {
        return $this->getPrimaryKey();
    }

    /* public function validatePassword($password)
      {
      return Yii::$app->security->validatePassword($password, $this->password_hash);
      } */

    public function validatePassword($password) {
        return Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey() {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey) {
        return $this->getAuthKey() === $authKey;
    }

    public static function findIdentityByAccessToken($token, $type = null) {
        return null;
    }

    public function beforeSave($insert) {

        if (parent::beforeSave($insert)) {

            if ($this->isNewRecord) {

                $this->authKey = \Yii::$app->security->generateRandomString();
                $this->password = Yii::$app->security->generatePasswordHash($this->password);
            }

            return true;
        }

        return false;
    }
    

    public function afterSave($insert) {
        // entra solamente si es insercion y no actualizacion
        if ($insert) {
            $body = "<h1>Haga click en el siguiente enlace para finalizar tu registro</h1>";
            $body .= "<a href='" . Yii::$app->params["direccion"] . Yii::$app->request->baseUrl . "/index.php/site/confirm?id=" . urlencode($this->id) . "&authKey=" . urlencode($this->authKey) . "'>CONFIRMAR REGISTRO</a>";
            Yii::$app->mailer->compose()
                    ->setTo($this->email)
                    ->setFrom([Yii::$app->params["adminEmail"] => Yii::$app->params["titulo"]])
                    ->setSubject("Terminar el registro")
                    ->setHtmlBody($body)
                    ->send();
        }
    }
    
    public static function isAdmin(){
        if(!Yii::$app->user->isGuest){
            return Yii::$app->user->identity->admin;
        }else{
          return 0;
        }
    }

}
