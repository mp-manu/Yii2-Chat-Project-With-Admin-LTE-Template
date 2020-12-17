<?php

namespace app\controllers;

use app\models\ChatUser;
use app\models\Message;
use app\models\User;
use Yii;
use app\models\Chat;
use app\models\ChatSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ChatController implements the CRUD actions for Chat model.
 */
class ChatController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionList(){
        $query = ChatUser::find()
            ->select(['*'])
            ->from('chat_user')
            ->innerJoin('user', 'user.user_id=chat_user.user_id')
            ->innerJoin('chat', 'chat.id=chat_user.chat_id');

        $users = User::find()->where(['!=', 'user_id', Yii::$app->user->getId()])->all();
        if(Yii::$app->session->has('user_type') && Yii::$app->session->get('user_type') != 'admin'){
            $chats = $query->where(['chat_user.user_id' => Yii::$app->user->getId()])->asArray()->all();
        }else{
            $chats = $query->asArray()->all();
        }
        foreach ($chats as $items){
            $getSecondUser = ChatUser::find()
                ->select('*')
                ->innerJoin('user', 'chat_user.user_id=user.user_id')
                ->where(['chat_id' => $items['chat_id']])
                ->andWhere(['!=', 'chat_user.user_id', Yii::$app->user->getId()])->asArray()->one();
            $secondUser[$items['chat_id']]['fio'] = $getSecondUser['fio'];
            $secondUser[$items['chat_id']]['id'] = $getSecondUser['user_id'];
        }

        return $this->render('list', ['chats' => $chats, 'users' => $users, 'secondUser' => $secondUser]);
    }
    /**
     * Lists all Chat models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ChatSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Chat model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Chat model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Chat();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Chat model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Chat model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionGetChat($id){
        $uid = Yii::$app->user->getId();
        $user = User::find()->where(['user_id' => $id])->asArray()->one();
        $chatName = $id.'_'.$uid;
        $chatName2 = $uid.'_'.$id;
        $chat = Chat::find()->where(['name' => $chatName])->orWhere(['name' => $chatName2])->asArray()->one();
        $model = new Message();
        if(empty($chat)){
            $chat_id = Chat::create($chatName);
            if(ChatUser::create($chat_id, $id) && ChatUser::create($chat_id, $uid)){
                $messages = Message::find()
                    ->select(['*'])
                    ->innerJoin('user', 'message.user_id=user.user_id')
                    ->where(['chat_id' => $chat_id])->asArray()->all();
                return $this->render('chat', [
                    'chat_id' => $chat_id,
                    'uid' => $uid,
                    'message' => $messages,
                    'user' => $user,
                    'model' => $model
                ]);
            }
        }else{
            $chat_id = $chat['id'];
        }
        $messages = Message::find()
            ->select(['*'])
            ->innerJoin('user', 'message.user_id=user.user_id')
            ->where(['chat_id' => $chat_id])->asArray()->all();
        return $this->render('chat', [
            'chat_id' => $chat_id,
            'uid' => $uid,
            'message' => $messages,
            'user' => $user,
            'model' => $model
        ]);
    }

    public function actionSendMessage(){
        $model = new Message();
        if($model->load(Yii::$app->request->post())){
            $model->created_at = time();
            $model->save();
            $chat = ChatUser::find()
                ->where(['chat_id' => $model->chat_id])
                ->andWhere(['!=', 'user_id', Yii::$app->user->getId()])
                ->asArray()
                ->one();
            return $this->redirect(['/chat/get-chat']);
        }
    }
    public function actionSendMessageAdmin(){
        $model = new Message();
        if($model->load(Yii::$app->request->post())){
            $model->created_at = time();
            $model->user_id = Yii::$app->user->getId();
            $model->save();
            return $this->redirect(['/chat/show-chat']);
        }
    }

    public function actionShowChat(){
        $model = new Message();
        $messages = Message::find()
            ->select(['*'])
            ->innerJoin('user', 'user.user_id=message.user_id')
            ->orderBy('message.created_at')
            ->asArray()->all();
        return $this->render('show-chat', [
            'message' => $messages,
            'model' => $model,
            'user_id' => Yii::$app->user->getId()
        ]);
    }

    /**
     * Finds the Chat model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Chat the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Chat::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
