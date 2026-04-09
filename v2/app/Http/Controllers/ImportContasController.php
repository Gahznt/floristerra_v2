<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\contasModel;
use Illuminate\Support\Facades\Validator;

class ImportContasController extends Controller
{
    public function import(Request $request)
    {
        // Validate the uploaded file
        $validator = Validator::make($request->all(), [
            'json_file' => 'required|file|max:10240', // 10MB max
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Get the file
        $file = $request->file('json_file');

        // Read the file content
        $content = file_get_contents($file->getRealPath());

        // Decode JSON
        $data = json_decode($content, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return response()->json(['error' => 'Invalid JSON file'], 400);
        }

        if (!is_array($data)) {
            return response()->json(['error' => 'JSON must be an array of objects'], 400);
        }

        $imported = 0;
        $errors = [];

        foreach ($data as $index => $item) {
            try {
                // Validate each item
                $itemValidator = Validator::make($item, [
                    'id' => 'required|integer',
                    'nomeconta' => 'required|string',
                    'vencimento' => 'required|date',
                    'valor' => 'required|numeric',
                    'boleto' => 'nullable|string',
                    'paga' => 'required|boolean',
                    'observacao' => 'nullable|string',
                    'created_at' => 'nullable|date',
                    'updated_at' => 'nullable|date',
                ]);

                if ($itemValidator->fails()) {
                    $errors[] = "Item " . ($index + 1) . ": " . implode(', ', $itemValidator->errors()->all());
                    continue;
                }

                // Create the record
                contasModel::create([
                    'id' => $item['id'],
                    'nomeconta' => $item['nomeconta'],
                    'vencimento' => $item['vencimento'],
                    'valor' => (float) $item['valor'],
                    'boleto' => $item['boleto'] ?? null,
                    'paga' => (int) $item['paga'],
                    'observacao' => $item['observacao'] ?? null,
                    'created_at' => isset($item['created_at']) ? $item['created_at'] : now(),
                    'updated_at' => isset($item['updated_at']) ? $item['updated_at'] : now(),
                ]);

                $imported++;
            } catch (\Exception $e) {
                $errors[] = "Item " . ($index + 1) . ": " . $e->getMessage();
            }
        }

        return response()->json([
            'message' => 'Import completed',
            'imported' => $imported,
            'errors' => $errors,
        ]);
    }
}
