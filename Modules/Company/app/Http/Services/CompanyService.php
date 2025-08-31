<?php

namespace Modules\Company\Http\Services;
use Hekmatinasser\Verta\Verta;
use Modules\Company\Models\Company;

class CompanyService
{
    public static function create($request)
    {
        return Company::query()->create([
           'name' => $request['name'],
           'user_id' => $request['user'] ?? auth()->user()->id,
           'slug' => $request['slug'] ?? null,
            'logo' => $request['logo'],
            'cover' => $request['cover'] ?? null,
            'foundation' => $request['foundation'] ?? null,
            'population' => $request['population'] ?? null,
            'expert' => $request['expert'],
            'tags' => $request['tags'] ?? null,
            'location' => json_encode([$request['companyLat'],$request['companyLang']]),
            'des' => $request['des'],
        ]);
    }

    public static function update($request,Company $company)
    {
        return $company->update([
            'name' => $request['name'] ?? $company->name,
            'user_id' => $request['user'] ?? $company->user_id,
            'slug' => $request['slug'] ?? $company->slug,
            'status' => $request['status'] ?? $company->status,
            'logo' => $request['logo'] ?? $company->logo,
            'cover' => $request['cover'] ?? $company->cover,
            'foundation' => $request['foundation'] ?? $company->foundation,
            'population' => $request['population'] ?? $company->population,
            'expert' => $request['expert'] ?? $company->expert,
            'des' => $request['des'] ?? $company->des,
            'tags' => $request['tags'] ?? $company->tags,
            'location' => ($request['companyLat'] && $request['companyLang']) ? json_encode([$request['companyLat'],$request['companyLang']]) : $company->location
        ]);
    }
}
