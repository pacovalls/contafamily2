<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Perfil;
use frontend\models\search\PerfilSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\PermisosHelpers;
use common\models\RegistrosHelpers;

/**
 * PerfilController implements the CRUD actions for Perfil model.
 */
class PerfilController extends Controller {
	public function behaviors() {
		return [ 
				'access' => [ 
						'class' => \yii\filters\AccessControl::className (),
						'only' => [ 
								'index',
								'view',
								'create',
								'update',
								'delete' 
						],
						'rules' => [ 
								[ 
										'actions' => [ 
												'index',
												'view',
												'create',
												'update',
												'delete' 
										],
										'allow' => true,
										'roles' => [ 
												'@' 
										] 
								] 
						]
						 
				],
				
				'verbs' => [ 
						'class' => VerbFilter::className (),
						'actions' => [ 
								'delete' => [ 
										'post' 
								] 
						] 
				] 
		];
	}
	
	/**
	 * Lists all Perfil models.
	 * 
	 * @return mixed
	 */
	public function actionIndex() {
		if ($ya_existe = RegistrosHelpers::userTiene ( 'perfil' )) {
			
			return $this->render ( 'view', [ 
					
					'model' => $this->findModel ( $ya_existe ) 
			]
			 );
		} else {
			
			return $this->redirect ( [ 
					'create' 
			] );
		}
	}
	
	/**
	 * Displays a single Perfil model.
	 * 
	 * @param string $id        	
	 * @return mixed
	 */
	public function actionView() {
		if ($ya_existe = RegistrosHelpers::userTiene ( 'perfil' )) {
			
			return $this->render ( 'view', [ 
					
					'model' => $this->findModel ( $ya_existe ) 
			]
			 );
		} else {
			
			return $this->redirect ( [ 
					'create' 
			] );
		}
	}
	
	/**
	 * Creates a new Perfil model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * 
	 * @return mixed
	 */
	public function actionCreate() {
		$model = new Perfil ();
		
		$model->user_id = \Yii::$app->user->identity->id;
		
		if ($ya_existe = RegistrosHelpers::userTiene ( 'perfil' )) {
			
			return $this->render ( 'view', [ 
					
					'model' => $this->findModel ( $ya_existe ) 
			]
			 );
		} elseif ($model->load ( Yii::$app->request->post () ) && $model->save ()) {
			
			return $this->redirect ( [ 
					'view' 
			] );
		} else {
			
			return $this->render ( 'create', [ 
					
					'model' => $model 
			]
			 );
		}
	}
	
	/**
	 * Updates an existing Perfil model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * 
	 * @param string $id        	
	 * @return mixed
	 */
	public function actionUpdate() {
		if ($model = Perfil::find ()->where ( [ 
				'user_id' => Yii::$app->user->identity->id 
		] )->one ()) {
			
			if ($model->load ( Yii::$app->request->post () ) && $model->save ()) {
				
				return $this->redirect ( [ 
						'view' 
				] );
			} else {
				
				return $this->render ( 'update', [ 
						'model' => $model 
				] );
			}
		} else {
			
			throw new NotFoundHttpException ( 'No Existe el Perfil.' );
		}
	}
	
	/**
	 * Deletes an existing Perfil model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * 
	 * @param string $id        	
	 * @return mixed
	 */
	public function actionDelete() {
		$model = Perfil::find ()->where ( [ 
				'user_id' => Yii::$app->user->identity->id 
		] )->one ();
		
		$this->findModel ( $model->id )->delete ();
		
		return $this->redirect ( [ 
				'site/index' 
		] );
	}
	
	/**
	 * Finds the Perfil model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * 
	 * @param string $id        	
	 * @return Perfil the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id) {
		if (($model = Perfil::findOne ( $id )) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException ( 'The requested page does not exist.' );
		}
	}
}
