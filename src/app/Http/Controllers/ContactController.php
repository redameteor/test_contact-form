<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function confirm(ContactRequest $request)
    {
        $contact = $request->only(['first_name', 'last_name', 'gender', 'email', 'tel', 'address', 'building', 'inquiry_type', 'detail']);

        return view('confirm', compact('contact'));
    }

    public function store(Request $request)
    {
        $contact = $request->only(['first_name', 'last_name', 'gender', 'email', 'tel', 'address', 'building', 'detail']);

        $genderMap = ['男性' =>1, '女性' =>2, 'その他' =>3];
        $contact['gender'] = $genderMap[$request->gender] ?? 3;

         $categoryMap = [
            '商品のお届けについて' => 1,
            '商品の交換について' => 2,
            '商品トラブル' => 3,
            'ショップへのお問い合わせ' => 4,
            'その他' => 5,
        ];

        $contact['category_id'] = $categoryMap[$request->inquiry_type] ?? 5;

        Contact::create($contact);

        return redirect('/thanks');
    }

        public function thanks()
        {
            return view('thanks');
        }

    public function admin(Request $request)
    {
        $query = Contact::with('category');

        if ($request->filled('keyword')) {
            $query->where(function($q) use ($request) {
                $q->where('first_name', 'like', '%' . $request->keyword . '%')
                  ->orwhere('last_name', 'like', '%' . $request->keyword . '%')
                  ->orwhere('email', 'like', '%' . $request->keyword . '%');
            }); 
        }

        if ($request->filled('gender') && $request->gender !== 'all') {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        
         if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $contacts =$query->orderBy('created_at', 'desc')->paginate(7);

        $categories = \App\Models\Category::all();

        return view('admin', compact('contacts', 'categories'));
    }

    public function destroy(Request $request) 
    {
        Contact::find($request->id)->delete();

        return redirect('/admin')->with('message', 'お問い合わせを削除しました');
    }

    public function export(Request $request)
    {
        $contacts = Contact::all();
        $csvHeader = ['ID', 'お名前', 'メールアドレス', '内容'];
        $csvData = [];

        foreach ($contacts as $contact) {
            $csvData[] = [
                $contact->id,
                $contact->first_name . $contact->last_name,
                $contact->email,
                $contact->detail
            ];
        }

        $response = new \Symfony\Component\HttpFoundation\StreamedResponse(function() use ($csvHeader, $csvData) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $csvHeader);
            foreach ($csvData as $row) {
                fputcsv($handle, $row);
            }
            fclose($handle);
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="contacts.csv"',
        ]);

        return $response;
    }
}