<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Automobiles;

class AjaxController extends Controller {
	public function addAutomobiles(Request $data) {
		$automibiles = json_decode($data['automibiles'], true);

		$automibilesModel = new Automobiles;

		$automibilesList = [];

		foreach ($automibiles as $item) {
			array_push($automibilesList, [
				'Brand' => $item['Brand'],
				'Model' => $item['Model'],
				'Year' => $item['Year']
			]);
		}

		$automibilesModel::insert($automibilesList);

		return $automibilesModel->select('Brand', 'Model', 'Year')->get();
	}
}
