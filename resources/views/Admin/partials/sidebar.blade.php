<div class="bg-dark text-white p-3 vh-100" style="width:260px;">

    <h3 class="text-center mb-4">
        📚 StudyMate AI
    </h3>

    <a href="{{ route('dashboard') }}" class="btn btn-dark w-100 text-start mb-2">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>

    <a href="{{ route('notes') }}" class="btn btn-dark w-100 text-start mb-2">
        <i class="bi bi-journal-bookmark"></i> Study Notes
    </a>

    <a href="{{ route('documents') }}" class="btn btn-dark w-100 text-start mb-2">
        <i class="bi bi-file-earmark-text"></i> Documents
    </a>

    <a href="{{ route('smart.chat') }}" class="btn btn-dark w-100 text-start mb-2">
        <i class="bi bi-robot"></i> Smart Chat
    </a>

   <a href="{{ route('chat.history') }}"
   class="btn btn-dark w-100 text-start mb-2">

    <i class="bi bi-clock-history"></i> Chat History

</a>

    <a href="{{ route('profile') }}"
   class="btn btn-dark w-100 text-start mb-2">

    <i class="bi bi-person-circle"></i> Profile

</a>
<a href="{{ route('invoice') }}"
class="btn btn-dark w-100 text-start mb-2">

<i class="bi bi-receipt"></i>

Invoice

</a>
    <hr>

    <a href="{{ route('logout') }}" class="btn btn-danger w-100">
        Logout
    </a>

</div>