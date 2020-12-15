<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "chat".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $type
 * @property int|null $status
 *
 * @property ChatUser[] $chatUsers
 * @property Message[] $messages
 */
class Chat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'chat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'status'], 'integer'],
            [['name'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'type' => 'Type',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[ChatUsers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChatUsers()
    {
        return $this->hasMany(ChatUser::className(), ['chat_id' => 'id']);
    }

    /**
     * Gets query for [[Messages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMessages()
    {
        return $this->hasMany(Message::className(), ['chat_id' => 'id']);
    }

    public static function create($name='chat'){
        $newChat = new self();
        $newChat->name = $name;
        $newChat->type = 1;
        $newChat->save();
        return $newChat->id;
    }

    public static function getLastMessage($id){
        $message = Chat::find()->select(['MAX(message.created_at)', 'message.*'])
            ->innerJoin('message', 'message.chat_id=chat.id')
            ->where(['chat.id' => $id])->asArray()->one();
        return (!empty($message)) ? $message['message'] : 'Пусто';
    }
}
