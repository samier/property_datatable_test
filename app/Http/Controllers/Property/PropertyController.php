<?php

namespace App\Http\Controllers\Property;

use App\Http\Resources\PropertyResource;
use App\Model\Property\Property;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PropertyController extends Controller {
    public function getList(Request $request) {
        $perPage = $request->get('perPage') ?: 20;
        $keyword = $request->get('keyword');
        $sort = $request->get('sort');
        $requestSortBy = $request->get('sortBy');

        $field = $request->get('field');

        $sortMap = [
            'title' => 'title',
            'description' => 'description',
            'for_sale' => 'fore_sale',
            'for_rent' => 'for_rent',
            'bedroom' => 'bedroom',
            'bathroom' => 'bathroom',
            'country_name' => 'countries.country',
            'type' => 'property_types.type',
            'status' => 'statuses.status',
            'project_name' => 'projects.name'
        ];

        $sortBy = 'id';
        if ( isset($sortMap[$requestSortBy]) ) {
            $sortBy = $sortMap[$requestSortBy];
        }

        if ( !in_array($sort, ['asc', 'desc']) ) {
            $sort = 'asc';
        }

        $properties = Property::query()->select('properties.*')
            ->leftJoin('statuses', 'statuses.id', '=', 'properties.status_id')
            ->leftJoin('projects', 'projects.id', '=', 'properties.project_id')
            ->leftJoin('property_types', 'property_types.id', '=', 'properties.property_type_id')
            ->leftJoin('regions', 'regions.id', '=', 'properties.region_id')
            ->leftJoin('countries', 'countries.id', '=', 'regions.country_id');

        if ( $keyword ) {
            $keyword = strtolower($keyword);
            switch ( $field ) {
                case 'title':
                {
                    $properties->where('title', 'LIKE', '%' . $keyword . '%');
                    break;
                }
                case 'description':
                {
                    $properties->where('description', 'LIKE', '%' . $keyword . '%');
                    break;
                }
                case 'bedroom':
                {
                    $properties->where('bedroom', 'LIKE', '%' . $keyword . '%');
                    break;
                }
                case 'bathroom':
                {
                    $properties->where('bathroom', 'LIKE', '%' . $keyword . '%');
                    break;
                }
                case 'for_sale':
                {
                    $properties->where('for_sale', strstr( 'yes', $keyword) ? true : (strstr( 'no', $keyword) ? false : $keyword));
                    break;
                }
                case 'for_rent':
                {
                    $properties->where('for_rent', strstr( 'yes', $keyword) ? true : (strstr( 'no', $keyword) ? false : $keyword));
                    break;
                }
                case 'status':
                {
                    $properties->where('statuses.status', 'LIKE', '%' . $keyword . '%');
                    break;
                }
                case 'country_name':
                {
                    $properties->where('countries.country', 'LIKE', '%' . $keyword . '%');
                    break;
                }
                case 'project_name':
                {
                    $properties->where('projects.name', 'LIKE', '%' . $keyword . '%');
                    break;
                }
                default:
                {
                    $properties->where('title', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('description', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('statuses.status', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('projects.name', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('property_types.type', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('countries.country', 'LIKE', '%' . $keyword . '%');
                    break;
                }
            }
        }

        $properties = $properties->orderBy($sortBy, $sort)->paginate($perPage);

        return PropertyResource::collection($properties);
    }

}
