<?php
namespace Controller;

require_once('../src/Model/Repository/NutrientRepository.php');
require_once('../src/Model/Repository/UserRepository.php');
require_once('../src/Model/Repository/TrainingRepository.php');
require_once('../src/Model/Entity/User.php');
require_once('../src/Model/Entity/Training.php');
use Model\Repository\UserRepository;
use Model\Repository\TrainingRepository;
use Model\Repository\NutrientRepository;
use Model\Entity\User;
use Model\Entity\Training;
use Utils\YamlHelper;

abstract class Controller {
	protected $paths;
	protected $userRepo;
	protected $trainingRepo;
	protected $nutrientRepo;

	function __construct() {
		$this->paths = YamlHelper::getPaths("path.yaml");
		$this->userRepo = new UserRepository();
		$this->trainingRepo = new TrainingRepository();
		$this->nutrientRepo = new NutrientRepository();
	}

	public function getAttribute($attributeName) {
		return $this->$attributeName;
	}

	public function setAttribute($attributeName, $value) {
		$this->$attributeName = $value;
	}
}