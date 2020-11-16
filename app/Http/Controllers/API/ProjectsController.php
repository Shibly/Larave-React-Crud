<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use App\Repositories\ProjectRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProjectsController extends Controller
{

    public $projectRepository;

    public function __construct(ProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    /**
     * @return JsonResponse
     * Get All projects
     */

    public function index()
    {
        return response()->json([
            'success' => true,
            'message' => 'Projects',
            'projects' => $this->projectRepository->getAll()
        ]);
    }


    /**
     * @param $id
     * @return JsonResponse
     * Show a project details
     */

    public function show($id)
    {

        $project = $this->projectRepository->findById($id);


        if (is_null($project)) {
            return response()->json([
                'success' => false,
                'message' => 'Project Details',
                'projects' => null
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Project Details',
            'projects' => $project
        ]);
    }


    /**
     * @param Request $request
     * @return JsonResponse
     * Store a project in database
     */

    public function store(Request $request)
    {

        $formData = $request->all();
        $validator = Validator::make($formData, [
            'name' => 'required',
            'description' => 'required',
            'user_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->getMessageBag()->first()
            ]);
        }


        $project = $this->projectRepository->create($request);

        return response()->json([
            'success' => true,
            'message' => 'Project Stored',
            'data' => $project
        ]);


    }


    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     * Update a project by project id
     */

    public function update(Request $request, $id)
    {
        $project = $this->projectRepository->findById($id);

        if (is_null($project)) {
            return response()->json([
                'success' => false,
                'message' => 'Project not found',
                'data' => null
            ]);
        }

        $formData = $request->all();
        $validator = Validator::make($formData, [
            'name' => 'required',
            'description' => 'required',
            'user_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->getMessageBag()->first()
            ]);
        }


        $project = $this->projectRepository->update($request, $id);

        return response()->json([
            'success' => true,
            'message' => 'Project Stored',
            'data' => $project
        ]);


    }


    /**
     * @param $id
     * @return JsonResponse
     * Delete a project from database
     */

    public function destroy($id)
    {
        $project = $this->projectRepository->findById($id);
        if (is_null($project)) {
            return response()->json([
                'success' => false,
                'message' => 'Project not found',
                'data' => null
            ]);
        }

        $project = $this->projectRepository->delete($id);
        return response()->json([
            'success' => true,
            'message' => 'Project has been deleted',
            'data' => $project
        ]);

    }


}
