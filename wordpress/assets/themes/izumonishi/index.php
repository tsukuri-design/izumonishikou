<?php declare(strict_types=1);

use App\Controller\ApiController;
use App\Controller\ExampleController;
use App\Controller\HomeController;
use App\Controller\LoginController;
use App\Controller\PostController;
use App\Controller\SingularController;
use App\Controller\ContactController;
use App\Controller\InformationSessionController;
use App\Controller\FaqController;
use App\Controller\TopicsController;
use App\Controller\SchoolLifeController;
use App\Controller\ClubActivitiesController;
use Mvc4Wp\Core\Service\App;

/*
 * --------------------------------------------------------------------
 * Route Definitions(add route)
 * any => {parameter_name}(same {parameter_name:[^/]+})
 * number => {parameter_name:\d+}
 * 
 * カスタムポストを増やすなら、ここを増やしてく
 * --------------------------------------------------------------------
 */

/*
 * Basic routes
 */
// Home routes
App::get()->router()->GET('/', [HomeController::class, 'index']);
App::get()->router()->GET('/index|/home|/home/|/home/index', [HomeController::class]);
App::get()->router()->GET('/home/other/{id:\d+}', [HomeController::class, 'other']);
App::get()->router()->GET('/home/redirect', [HomeController::class, 'redirect']);

// Contact routes（/contact/ 固定ページでRecaptcha設定が必要です）
// App::get()->router()->GET('/contact|/contact/', [ContactController::class, 'index']);
// App::get()->router()->POST('/contact|/contact/', [ContactController::class, 'post']);

// //Information session
App::get()->router()->GET('/admission/events/', [InformationSessionController::class, 'index']);
// App::get()->router()->GET('/admissions-information/high-school/events/', [InformationSessionController::class, 'index']);

// //information
App::get()->router()->GET('/information/', [TopicsController::class, 'index']);
App::get()->router()->GET('/information/page/{page}/', [TopicsController::class, 'index']);
App::get()->router()->GET('/information/page/{page}', [TopicsController::class, 'index']);
App::get()->router()->GET('/information/page/{page}/', [TopicsController::class, 'index']);
App::get()->router()->GET('/topics_category/', [TopicsController::class, 'index']);
App::get()->router()->GET('/topics_category/page/{page:\d+}/', [TopicsController::class, 'index']);
App::get()->router()->GET('/topics_category/{category}/', [TopicsController::class, 'index']);
App::get()->router()->GET('/topics_category/{category}/page/{page:\d+}/', [TopicsController::class, 'index']);
App::get()->router()->GET('/current-students/information/', [TopicsController::class, 'index']);
App::get()->router()->GET('/current-students/information/page/{page}', [TopicsController::class, 'index']);
App::get()->router()->GET('/current-students/information/page/{page}/', [TopicsController::class, 'index']);

// School Life
App::get()->router()->GET('/school-life/club-activities/', [ClubActivitiesController::class, 'club_activities']);

// //faq
// App::get()->router()->GET('/contact/faq/', [FaqController::class, 'index']);
// App::get()->router()->GET('/faq/', [FaqController::class, 'index']);

// Singular
// App::get()->router()->GET('/topics/{slug}/', [SingularController::class, 'main']);
App::get()->router()->GET('/{slug}/', [SingularController::class, 'other']);
App::get()->router()->GET('/{slug:.+}/', [SingularController::class, 'other']);

/*
 * --------------------------------------------------------------------
 * Run application
 * --------------------------------------------------------------------
 */
App::get()->run();