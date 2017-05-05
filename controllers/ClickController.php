<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\ArrayHelper;
use app\models\Click;
use app\models\BadDomains;

class ClickController extends Controller
{
    private $requireParams = [
        'param1'
    ];
    
    private $clickId;
    private $badDomain = false;
    
    /**
     * 
     * @return mixed
     */
    public function actionIndex()
    {
        if($this->checkRequireParams(Yii::$app->request->queryParams))
        {
            $this->generateUniqueId(Yii::$app->request->queryParams);
            $this->checkBadDomain();
            return $this->processingClick();
        }
    }
    
    private function processingClick()
    {
        $click = new Click();
        
        if($this->checkUniqueClick()) 
        {
            $insert['Click'] = [
                'click_id' => $this->clickId,
                'ua' => Yii::$app->request->getUserAgent(),
                'ip' => ip2long(Yii::$app->request->getUserIP()),
                'ref' => Yii::$app->request->getReferrer(),
                'param1' => Yii::$app->request->get('param1'),
                'param2' => Yii::$app->request->get('param2', NULL),
                'bad_domain' => (int)$this->badDomain
            ];

            if($click->load($insert) && $click->insert())
            {
                return $this->render('success', [
                    'clickId' => $this->clickId,
                    'badDomain' => $this->badDomain
                ]);
            }
        }
        else 
        {
            $currentClick = $click->findOne(['click_id' => $this->clickId]);
            $currentClick->error = $currentClick->error + 1; 
            
            if($this->badDomain)
            {
                $currentClick->bad_domain = 1;
            }
            if($currentClick->update())
            {
                return $this->render('error', [
                    'clickId' => $this->clickId,
                    'badDomain' => $this->badDomain
                ]);
            }
        }
    }
    
    private function checkBadDomain()
    {
        $this->badDomain = !is_null(BadDomains::findOne(['name' => Yii::$app->request->getReferrer()]));
        return true;
    }
    
    private function checkUniqueClick() 
    {
        return is_null(Click::findOne(['click_id' => $this->clickId]));
    }
    
    private function generateUniqueId($params)
    {
        $values = [
            Yii::$app->request->getUserAgent(),
            Yii::$app->request->getUserIP(),
            Yii::$app->request->getReferrer(),
            $params['param1']
        ];

        $this->clickId = hash('haval256,3', implode(',', $values), false);
        return true;
    }
    
    /**
     * 
     * @param type $params
     * @return bool
     */
    private function checkRequireParams($params)
    {
        $requestParams = array_keys($params);
        return ArrayHelper::isSubset($this->requireParams, $requestParams);
    }
}
