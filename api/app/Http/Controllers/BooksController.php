<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Borrows;
use App\Models\Students;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function getBooks()
    {
        $books = Books::all();
        if (!$books) {
            return response()->json([
                'message' => 'error when getting books'
            ], 500);
        } else {
            return response()->json([
                'books' => $books
            ], 200);
        }
    }
    public function borrow(Request $request)
    {
        $validation = $request->validate([
            'id' => 'required',
            'token' => 'required'
        ]);

        $student = Students::where('token', $request->token)->first();
        $book = Books::where('id', $request->id)->first();
        if (!$book) {
            return response()->json([
                'message' => 'book not found'
            ], 404);
        } else {
            $borrow = Books::where('id', $request->id)->update([
                'is_borrow' => 1
            ]);
            $borrowDetail = Borrows::create([
                'student_id' => $student->id,
                'book_id' => $book->id
            ]);
            if (!$borrowDetail) {
                return response()->json([
                    'message' => 'error at setting borrow detail'
                ], 500);
            } else {
                return response()->json([
                    'message' => 'borrow successful',
                    'book' => $book
                ], 200);
            }
        }
    }

    // public function returnBook(Request $request) {
    //     $validation = $request->validate([
    //         'id' => 'required',
    //         'token' => 'required'
    //     ]);

    //     $student = Students::where('token', $request->token)->first();
    //     $book = Books::where('id', $request->id)->first();
    //     if (!$book) {
    //         return response()->json([
    //             'message' => 'book not found'
    //         ], 404);
    //     } else {
    //         // $borrow = Books::where('id', $request->id)->update([
    //         //     'is_borrow' => 1
    //         // ]);
    //         // $borrowDetail = borrows::create([
    //         //     'student_id' => $student->id,
    //         //     'book_id' => $book->id
    //         // ]);
    //         // if (!$borrowDetail) {
    //         //     return response()->json([
    //         //         'message' => 'error at setting borrow detail'
    //         //     ], 500);
    //         // } else {
    //         //     return response()->json([
    //         //         'message' => 'borrow successful',
    //         //         'book' => $book
    //         //     ], 200);
    //         // }
    //         $return = Books::where('id', $request->id)->update([
    //             'is_borrow' => 0
    //         ]);
    //         $returnDetail = Borrows::where('')
    //     }
    // }
}
