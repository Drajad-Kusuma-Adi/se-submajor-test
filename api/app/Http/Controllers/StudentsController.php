<?php

namespace App\Http\Controllers;

use App\Models\Students;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    public function login(Request $request)
    {
        $validation = $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);

        $student = Students::where('name', $request->name)->first();
        if (!$student) {
            return response()->json([
                'message' => 'name not found'
            ], 404);
        } else {
            if ($student->password == md5($request->password)) {
                $token = md5($request->name . $request->password);
                $addToken = Students::where('name', $request->name)->update([
                    'token' => $token
                ]);
                if (!$addToken) {
                    return response()->json([
                        'message' => 'error when adding token'
                    ], 500);
                } else {
                    return response()->json([
                        'name' => $student->name,
                        'token' => $token
                    ], 200);
                }
            } else {
                return response()->json([
                    'message' => 'invalid password'
                ], 401);
            }
        }
    }
    public function logout(Request $request)
    {
        $validation = $request->validate([
            'token' => 'required'
        ]);

        $student = Students::where('token', $request->token)->first();
        if (!$student) {
            return response()->json([
                'message' => 'student not found'
            ], 404);
        } else {
            $logout = Students::where('token', $request->token)->update([
                'token' => null
            ]);
            if (!$logout) {
                return response()->json([
                    'message' => 'error when resettin token'
                ], 500);
            } else {
                return response()->json([
                    'message' => 'logout successful'
                ], 200);
            }
        }
    }
}
