<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\ContactsManager;

class ContactsManagerController extends \yii\web\Controller
{
    public $enableCsrfValidation = false;
    
    public function actionIndex()
    {
        $contacts = ContactsManager::find()->asArray()->all();
        return json_encode($contacts);
    }
    
    public function actionAdd()
    {
        $input = json_decode(file_get_contents('php://input'));
        $contacts = new ContactsManager();
        $contacts->first_name = $input->first_name;
        $contacts->last_name = $input->last_name;
        $contacts->email_address = $input->email_address;
        $contacts->description = $input->description;
        if($contacts->save())
        {
            $id = ContactsManager::find()->where('email_address = :email_address', [':email_address' => $input->email_address])->asArray()->one();
            
            $insertedData = array(
                'id' => $id['id'],
                'first_name' => $input->first_name,
                'last_name' => $input->last_name,
                'email_address' => $input->email_address,
                'description' => $input->description
            );
            
            return json_encode($insertedData);
        }
    }
    
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        if ($request->isPut) 
        {
            $input = json_decode(file_get_contents('php://input'));
            $contacts = ContactsManager::findOne($id);
            $contacts->first_name = $input->first_name;
            $contacts->last_name = $input->last_name;
            $contacts->email_address = $input->email_address;
            $contacts->description = $input->description;
            $contacts->update();
        }
        
        return $this->render('update');
    }
    
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        if ($request->isDelete) 
        {
            ContactsManager::deleteAll('id = :id', ['id' => $id]);
        }
    }

}
