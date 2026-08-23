<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudyNote;
use App\Models\Document;
use App\Models\ChatMessage;
use App\Services\GeminiService;
use Smalot\PdfParser\Parser;
use App\Models\Profile;
use Spatie\Browsershot\Browsershot;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    // Display Notes
   public function notes(Request $request)
{
    $search = $request->search;

$notes = StudyNote::when($search, function ($query) use ($search) {

    $query->where('title', 'LIKE', '%' . $search . '%')
          ->orWhere('subject', 'LIKE', '%' . $search . '%');

})->paginate(5);

    return view('Admin.notes', compact('notes', 'search'));
}

    // Store Note
    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|max:100',
        'subject' => 'required|max:100',
        'description' => 'required',
        'pdf' => 'nullable|mimes:pdf|max:2048'
    ]);

    DB::beginTransaction();

    try{

        $note = new StudyNote();

        $note->title = $request->title;
        $note->subject = $request->subject;
        $note->description = $request->description;

        if($request->hasFile('pdf'))
        {
            $file = time().'.'.$request->pdf->extension();

            $request->pdf->move(public_path('uploads'),$file);

            $note->pdf = $file;
        }

        $note->save();

        DB::commit();

        Log::info('Study Note Added',[
            'title'=>$note->title
        ]);

        return redirect()->back()
            ->with('success','Note Added Successfully');

    }catch(\Exception $e){

        DB::rollBack();

        Log::error('Study Note Add Failed',[
            'error'=>$e->getMessage()
        ]);

        return redirect()->back()
            ->with('error','Something went wrong');
    }
}
    // Edit Note
public function edit($id)
{
    $note = StudyNote::findOrFail($id);

    return view('edit_note', compact('note'));
}

// Update Note
public function update(Request $request,$id)
{
    DB::beginTransaction();

    try{

        $note = StudyNote::findOrFail($id);

        $note->title = $request->title;
        $note->subject = $request->subject;
        $note->description = $request->description;

        if($request->hasFile('pdf'))
        {
            $file = time().'.'.$request->pdf->extension();

            $request->pdf->move(public_path('uploads'),$file);

            $note->pdf = $file;
        }

        $note->save();

        DB::commit();

        Log::info('Study Note Updated',[
            'id'=>$id
        ]);

        return redirect()->route('notes')
            ->with('success','Note Updated Successfully');

    }catch(\Exception $e){

        DB::rollBack();

        Log::error('Study Note Update Failed',[
            'error'=>$e->getMessage()
        ]);

        return redirect()->back();
    }
}

// Delete Note
public function delete($id)
{
    DB::beginTransaction();

    try{

        $note = StudyNote::findOrFail($id);

        $note->delete();

        DB::commit();

        Log::info('Study Note Deleted',[
            'id'=>$id
        ]);

        return redirect()->route('notes')
            ->with('success','Note Deleted Successfully');

    }catch(\Exception $e){

        DB::rollBack();

        Log::error('Study Note Delete Failed',[
            'error'=>$e->getMessage()
        ]);

        return redirect()->back();
    }
}
public function documents(Request $request)
{
    $search = $request->search;

    $documents = Document::when($search, function ($query) use ($search) {

        $query->where('title', 'LIKE', '%' . $search . '%')
              ->orWhere('category', 'LIKE', '%' . $search . '%');

    })->orderBy('id','ASC')->paginate(5);

    return view('Admin.documents', compact('documents'));
}
public function documentStore(Request $request)
{
    $request->validate([
        'title' => 'required',
        'category' => 'required',
        'document' => 'required|mimes:pdf|max:10240'
    ]);

    DB::beginTransaction();

    try{

        $document = new Document();

        $document->title = $request->title;
        $document->category = $request->category;

        if($request->hasFile('document'))
        {
            $extension = $request->file('document')->getClientOriginalExtension();

            $fileName = time().'.'.$extension;

            $request->file('document')->move(
                public_path('uploads/documents'),
                $fileName
            );

            $document->file_name = $fileName;
            $document->file_type = $extension;

            $parser = new Parser();

            $pdf = $parser->parseFile(
                public_path('uploads/documents/'.$fileName)
            );

            $document->document_text = $pdf->getText();
        }

        $document->save();

        DB::commit();

        Log::info('Document Uploaded Successfully',[
            'title'=>$document->title,
            'category'=>$document->category
        ]);

        return redirect()->back()
            ->with('success','Document Uploaded Successfully');

    }
    catch(\Exception $e){

        DB::rollBack();

        Log::error('Document Upload Failed',[
            'error'=>$e->getMessage()
        ]);

        return redirect()->back()
            ->with('error','Document Upload Failed');
    }
}
public function documentUpdate(Request $request,$id)
{
    $request->validate([
        'title'=>'required|max:100',
        'category'=>'required|max:100'
    ]);

    DB::beginTransaction();

    try{

        $document = Document::findOrFail($id);

        $document->title = $request->title;
        $document->category = $request->category;

        $document->save();

        DB::commit();

        Log::info('Document Updated',[
            'id'=>$id
        ]);

        return redirect()->back()
            ->with('success','Document Updated Successfully');

    }
    catch(\Exception $e){

        DB::rollBack();

        Log::error('Document Update Failed',[
            'error'=>$e->getMessage()
        ]);

        return redirect()->back()
            ->with('error','Update Failed');
    }
}

public function documentDelete($id)
{
    DB::beginTransaction();

    try{

        $document = Document::findOrFail($id);

        if(file_exists(public_path('uploads/documents/'.$document->file_name)))
        {
            unlink(public_path('uploads/documents/'.$document->file_name));
        }

        $document->delete();

        DB::commit();

        Log::info('Document Deleted',[
            'id'=>$id
        ]);

        return redirect()->back()
            ->with('success','Document Deleted Successfully');

    }
    catch(\Exception $e){

        DB::rollBack();

        Log::error('Document Delete Failed',[
            'error'=>$e->getMessage()
        ]);

        return redirect()->back()
            ->with('error','Delete Failed');
    }
}
public function smartChat()
{
    $messages = ChatMessage::latest()->get();

    return view('Admin.smart_chat', compact('messages'));
}
public function sendMessage(Request $request, GeminiService $gemini)
{
    $request->validate([
        'question' => 'required'
    ]);

    DB::beginTransaction();

    try{

        $question = $request->question;

        $keywords = $this->extractKeywords($question);

        $document = $this->searchDocuments($keywords);

        if($document){

            $context = $this->getRelevantParagraph(
                $document->document_text,
                $keywords
            );

            $prompt = "
You are StudyMateAI.

Use the uploaded study material as the primary source.

Study Material:
-----------------------
$context
-----------------------

Question:
$question

If the study material answers the question,
use it.

Otherwise answer using your general knowledge,
and mention that the answer comes from general knowledge.
";

            $response = $gemini->ask($prompt);

        }else{

            $response = $gemini->ask($question);

        }

        $answer = "No response from Gemini.";

        if(isset($response['candidates'][0]['content']['parts'][0]['text']))
        {
            $answer = $response['candidates'][0]['content']['parts'][0]['text'];
        }

        ChatMessage::create([
            'question'=>$question,
            'answer'=>$answer
        ]);

        DB::commit();

        Log::info('Chat Saved',[
            'question'=>$question
        ]);

        return redirect()->back()
            ->with('success','Message Sent Successfully');

    }
    catch(\Exception $e){

        DB::rollBack();

        Log::error('Chat Failed',[
            'error'=>$e->getMessage()
        ]);

        return redirect()->back()
            ->with('error','Something went wrong');
    }
}
private function searchDocuments($keywords)
{
    $documents = Document::all();

    foreach ($documents as $document) {

        foreach ($keywords as $keyword) {

            if (stripos($document->document_text, $keyword) !== false) {

                return $document;

            }
        }

    }

    return null;
}
private function extractKeywords($text)
{
    // Convert to lowercase
    $text = strtolower($text);

    // Remove punctuation
    $text = preg_replace('/[^a-z0-9 ]/', '', $text);

    // Split into words
    $words = explode(' ', $text);

    // Common words to ignore
    $stopWords = [
        'what','is','are','the','a','an','of','to','for',
        'and','in','on','with','how','explain','define',
        'about','give','me','tell'
    ];

    // Remove stop words
    $keywords = array_diff($words, $stopWords);

    return array_values(array_filter($keywords));
}

private function getRelevantParagraph($text, $keywords)
{
    $paragraphs = preg_split("/\r\n|\n|\r/", $text);

    foreach ($paragraphs as $paragraph) {

        foreach ($keywords as $keyword) {

            if (stripos($paragraph, $keyword) !== false) {

                return $paragraph;

            }
        }
    }

    return substr($text, 0, 1500);
}
public function chatHistory(Request $request)
{
    $search = $request->search;

    $messages = ChatMessage::when($search, function ($query) use ($search) {

        $query->where('question','LIKE','%'.$search.'%')
              ->orWhere('answer','LIKE','%'.$search.'%');

    })->latest()->paginate(10);

    return view('Admin.chat_history', compact('messages'));
}

public function deleteChat($id)
{
    ChatMessage::findOrFail($id)->delete();

    return redirect()->back()
        ->with('success','Chat Deleted Successfully');
}
public function profile()
{
    $profile = Profile::first();

    if(!$profile)
    {
        $profile = Profile::create([

            'name'=>'Administrator',

            'email'=>'admin@gmail.com'

        ]);
    }

    return view('Admin.profile',compact('profile'));
}
public function profileUpdate(Request $request)
{
    DB::beginTransaction();

    try{

        $profile = Profile::first();

        $profile->name = $request->name;
        $profile->email = $request->email;
        $profile->phone = $request->phone;

        if($request->hasFile('image'))
        {
            $file = time().'.'.$request->image->extension();

            $request->image->move(
                public_path('uploads/profile'),
                $file
            );

            $profile->image = $file;
        }

        $profile->save();

        DB::commit();

        Log::info('Profile Updated',[
            'email'=>$profile->email
        ]);

        return redirect()->back()
            ->with('success','Profile Updated Successfully');

    }
    catch(\Exception $e){

        DB::rollBack();

        Log::error('Profile Update Failed',[
            'error'=>$e->getMessage()
        ]);

        return redirect()->back()
            ->with('error','Profile Update Failed');
    }
}
public function downloadChatHistory()
{
    $messages = ChatMessage::latest()->get();

    $html = view('Admin.chat_history_pdf', compact('messages'))->render();

    $pdfPath = public_path('chat_history.pdf');

    Browsershot::html($html)
    ->setNodeBinary('C:\Program Files\nodejs\node.exe')
    ->setNpmBinary('C:\Program Files\nodejs\npm.cmd')
    ->format('A4')
    ->savePdf($pdfPath);

    return response()->download($pdfPath)->deleteFileAfterSend(true);
}
public function invoice()
{
    $invoice = Invoice::first();

    if(!$invoice){

        $invoice = Invoice::create([

            'invoice_no'=>'INV-2026-001',

            'customer_name'=>'Admin',

            'plan'=>'Premium Plan',

            'amount'=>299,

            'gst'=>53.82,

            'total'=>352.82,

            'status'=>'PAID'

        ]);
    }

    return view('Admin.invoice',compact('invoice'));
}




}

