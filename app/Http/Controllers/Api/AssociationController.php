<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Association;
use App\Models\Image;
use App\Models\Plan;
use App\Models\Value;
use Illuminate\Http\Request;

class AssociationController extends Controller
{
    public function objective()
    {
        $data = array();
        $association = Association::query()->where('primary_title', 'objective1')->select('title', 'id')->first();
        if ($association) {
            $values = Value::query()->where('association_id', $association->id)->select('title')->get();
            array_push($data, $association, $values);
        }

        if (!empty($data)) {
            return returnData(200, '', $data);
        } else {
            return returnNoData();
        }
    }

    public function vision()
    {
        $data = array();
        $vision = Association::query()->where('primary_title', 'vision')
            ->select('title', 'vision', 'message', 'id')->first();
        if ($vision) {
            $values = Value::query()->where('association_id', $vision->id)->select('title')->get();
            array_push($data, $vision, $values);
        }

        if (!empty($data)) {
            return returnData(200, '', $data);
        } else {
            return returnNoData();
        }
    }

    public function plan()
    {
        $data = array();
        $plan = Association::query()->where('primary_title', 'plan')
            ->select('title', 'id')->first();
        if ($plan) {
            $plans = Plan::query()->where('association_id', $plan->id)->select('title', 'name', 'pdf')->get();
            array_push($data, $plan, $plans);
        }

        if (!empty($data)) {
            return returnData(200, '', $data);
        } else {
            return returnNoData();
        }
    }

    public function chart()
    {
        $data = array();
        $chart = Association::query()->where('primary_title', 'chart')
            ->select('title', 'id')->first();
        if ($chart) {
            $images = Image::query()->where('association_id', $chart->id)->select('path')->get();
            array_push($data, $chart, $images);
        }

        if (!empty($data)) {
            return returnData(200, '', $data);
        } else {
            return returnNoData();
        }
    }
    public function committee()
    {
        $data = array();
        $committee = Association::query()->where('primary_title', 'committee')
            ->select('title', 'id')->first();
        if ($committee) {
            $images = Image::query()->where('association_id', $committee->id)->select('path')->get();
            array_push($data, $committee, $images);
        }

        if (!empty($data)) {
            return returnData(200, '', $data);
        } else {
            return returnNoData();
        }
    }

    public function boss()
    {
        $data = array();
        $boss = Association::query()->where('primary_title', 'boss')
            ->select('title', 'name', 'phone', 'email', 'address', 'id')->first();
        if ($boss) {
            $images = Image::query()->where('association_id', $boss->id)->select('path')->get();
            array_push($data, $boss, $images);
        }

        if (!empty($data)) {
            return returnData(200, '', $data);
        } else {
            return returnNoData();
        }
    }
}
