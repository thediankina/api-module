<?php

namespace app\models\db;

use xutl\snowflake\SnowflakeBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\db\Query;
use yii\web\IdentityInterface;

/**
 * @property int $id
 * @property string $login
 * @property string $password_hash
 * @property string|null $access_token
 * @property string $created_at
 * @property string|null $updated_at
 */
class User extends ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors(): array
    {
        return [
            'snowflake' => [
                'class' => SnowflakeBehavior::class,
                'attribute' => 'id',
            ],
            'timestamp' => [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('now()'),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['login', 'password_hash', 'access_token'], 'required'],
            [['login', 'password_hash', 'access_token'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [
                'login',
                'unique',
                'when' => fn(self $model) => $model->isAttributeChanged('login'),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function fields(): array
    {
        return [
            'id' => 'id',
            'login' => 'login',
            'created_at' => 'created_at',
            'updated_at' => function (self $model) {
                if (is_object($model->updated_at)) {
                    $datetime = (new Query())->select($model->updated_at)->scalar();
                    return Yii::$app->formatter->asDate($datetime, 'php:Y-m-d H:i:s');
                }

                return $model->updated_at;
            },
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id): ?IdentityInterface
    {
        return static::findOne(['id' => $id]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null): ?IdentityInterface
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * {@inheritdoc}
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey(): ?string
    {
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey): ?bool
    {
        return null;
    }
}
