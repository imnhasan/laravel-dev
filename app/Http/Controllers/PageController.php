<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Whoops\Run;

class PageController extends Controller
{
    public function index()
    {
        $companies = Company::query()->paginate($perPage = 10, $columns = ['*'], $pageName = 'companies');
        $users = User::query()->paginate($perPage = 10, $columns = ['*'], $pageName = "users");
        return view('page', compact('companies', 'users'));
    }

    public function pageCard(Request $request)
    {
        //dd($request->company_id);
        $companies = Company::query()->paginate(10);

        // dd($companies[0]->users());

        if ($request->ajax()) {
            return response()->view('page-card.page_card_table', compact('companies'));
        }

        return view('page-card.page_card', compact('companies'));
    }

    public function pageInPage(Request $request)
    {
        $companies = Company::query()->paginate(
            $perPage = 10,
            $columns = ['*'],
            $pageName = "companies",
            $pageNumber = $request->companies,
            $perPage = 0,
        );

        $data ['companies'] = $companies;

        $companyId = $request->company_id;
        $userPageLink = $request->users;

        $check = [];

        $test = User::query()->where('company_id', $companyId)->offset($userPageLink * 5)->limit(5)->get();

        foreach ($companies as $key => $company) {
            dump($company->id == $companyId);
            if($company->id == $companyId) {
                $store = $company->where('id', $companyId)->get();
                $data['companies'][$key]['users'] = $store[0]->usersOnly()->paginate(
                    $perPage = 5,
                    $columns = ['*'],
                    $pageName = "company-.$companyId/users-$companyId",
                    $pageNumber = $request->users,
                );
            } else {
                $data['companies'][$key]['users'] = $company->usersOnly()->paginate(
                    $perPage = 5,
                    $columns = ['*'],
                    $pageName = "company.-.$companyId/users-$companyId",
                    $pageNumber = 1,
                );
            }
            //dump($data['companies'][$key]['users']);
        }

        return view('page-in-page.page_in_page', compact('data'));
    }
}
