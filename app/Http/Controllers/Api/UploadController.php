<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\InvalidFileException;
use App\Http\Controllers\Controller;
use App\Http\Requests\UploadPostRequest;
use App\Services\FileParser\JsonTextParserService;
use App\Services\Invitation\InvitationService;
use Illuminate\Http\JsonResponse;

// Constant from base class referenced via child class
use Symfony\Component\HttpFoundation\Response as BaseResponse;

/**
 * Api Upload Controller
 */
final class UploadController extends Controller
{
    /**
     * @param UploadPostRequest $request
     * @return JsonResponse
     */
    public function __invoke(UploadPostRequest $request) : JsonResponse
    {
        // default response
        $response = [
            'body' => [
                'success' => true
            ],
            'status_code' => BaseResponse::HTTP_OK
        ];

        try
        {
            // Retrieve the validated data
            $validatedData = $request->validated();

            // parse given file
            $jsonCollection = JsonTextParserService::make()->parse($validatedData['file']);

            // if there is no data we can assume the file parsing failed or the file it's empty
            if ($jsonCollection->isEmpty())
            {
                throw new InvalidFileException;
            }

            // update Invitees infos
            InvitationService::make()
                ->setInvitees($jsonCollection)
                ->updateAffiliates();
        }
        catch (\Exception $exception)
        {
            // error response
            $response = [
                'body' => [
                    'error' => true,
                    'message' => 'File Processing failed, please try again later'
                ],
                'status_code' => BaseResponse::HTTP_UNPROCESSABLE_ENTITY
            ];
        }

        // return response with success or error
        return \response()->json($response['body'], $response['status_code']);
    }
}
