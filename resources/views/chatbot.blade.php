@extends('layouts.app')
@section('content')
<script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>

<div class="container flex flex-col h-screen">
  <div class="flex justify-left items-center">
    <img src="{{ asset('images/roki.png') }}" alt="Maskot" class="w-32 h-30">
    <div class="ml-4 text-left">
      <h1 class="text-5xl font-bold">Hai,</h1>
      <h2 class="text-5xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-pink-500 to-blue-500">{{ Auth::user()->firstname }}!</h2>
      <p class="text-gray-600 text-lg">Butuh bantuan? tanya Roki yuk!</p>
    </div>
  </div>

  <div class="messages flex-grow p-4 overflow-y-auto">
    @foreach ($chatHistory as $chat)
      <div class="right message flex justify-end mb-4">
        <p class="bg-blue-300 rounded-lg p-3 max-w-xs">{{ $chat->user_message }}</p>
      </div>
      <div class="left message flex mb-4">
        <img class="w-10 h-10 rounded-full mr-2 self-start" src="/images/roki_avatar.png" alt="Avatar">
        <div class="chat-bubble bg-gray-300 rounded-lg p-3 markdown-content">{{ $chat->bot_response }}</div>
      </div>
    @endforeach
    
    @if (count($chatHistory) === 0)
      <div class="left message flex mb-4">
        <img class="w-10 h-10 rounded-full mr-2 self-end" src="/images/roki_avatar.png" alt="Avatar">
        <p class="flex bg-gray-300 rounded-lg p-3 max-w-xs">Hai! Butuh bantuan untuk rancangan tugas? Tanya Roki aja sini!</p>
      </div>
    @endif
  </div>

  <div class="p-1 bg-white border-t sticky bottom-0 z-20">
    <form class="flex gap-2">
      <input type="text" id="message" name="message" 
             class="flex-grow border rounded-full px-4 py-2" 
             placeholder="Ketik pesan di sini..." 
             autocomplete="off">
      <button type="submit" 
              class="bg-blue-500 text-white px-6 py-2 rounded-full hover:bg-blue-600 transition-colors">
        Kirim
      </button>
    </form>
    
    @if(Auth::user()->tier !== 'PRO')
      <p class="text-xs text-gray-500 text-right mt-1">Sisa kuota chat: {{ Auth::user()->ischatting }}</p>
    @else
      <p class="text-xs text-blue-500 text-right mt-1">Sisa kuota chat: tidak terbatas</p>
    @endif
  </div>
</div>

<!-- Modal untuk upgrade paket yang bisa dibuka dari tombol -->
<div id="upgradeModal" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
  <div class="bg-white rounded-2xl shadow-xl max-w-2xl w-[90%] p-6 text-center relative">
    <h2 class="text-2xl font-bold text-red-600 mb-4">Kuota Chat Habis!</h2>
    <img src="{{ asset('images/roki1.png') }}" alt="Rakun" class="w-28 mx-auto my-4">
    <p class="mb-6 text-gray-700">Kamu telah mencapai batas penggunaan fitur chatbot. Dengan berlangganan paket premium, kamu bisa mengobrol dengan Roki tanpa batas!</p>
    
    <div class="flex justify-center gap-4 text-left text-sm">
        @foreach ($packages as $package)
            <div class="border {{ $package->name === 'Pro' ? 'border-blue-500' : '' }} rounded-xl p-4 w-1/2 shadow">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="font-bold text-lg
                        {{ $package->name === 'Pro' ? 'bg-gradient-to-r from-pink-500 to-blue-500 text-transparent bg-clip-text' : '' }}">
                        {{ $package->name }}
                        @if ($package->price > 0)
                            <span class="line-through text-sm text-gray-400">
                                Rp. {{ number_format($package->price, 0, ',', '.') }}/12 bln
                            </span>
                        @endif
                    </h3>
                    @if ($package->name === 'Pro')
                        <button onclick="openCheckoutModal()" class="bg-pink-500 text-white px-4 py-1 rounded-full text-sm hover:bg-pink-600">
                            Beli
                        </button>
                    @endif
                </div>

                <ul class="mt-4 space-y-2">
                    @foreach ($package->features as $feature)
                        <li class="flex items-start gap-2">
                            @if ($package->name === 'Pro')
                                <svg class="w-5 h-5 text-pink-500 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                            @else
                                <svg class="w-5 h-5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            @endif
                            <span class="text-gray-800">{{ $feature }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>

    <button onclick="closeUpgradeModal()" class="mt-6 inline-block text-gray-600 hover:underline font-bold">Kembali ke Chat</button>
  </div>
</div>

<div id="checkoutModal" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
  <div class="bg-white rounded-2xl shadow-xl max-w-md w-[90%] p-6 text-center relative">
      <h2 class="text-2xl font-bold bg-gradient-to-r from-pink-500 to-blue-500 text-transparent bg-clip-text">Pro</h2>
      <img src="{{ asset('images/roki1.png') }}" alt="Rakun" class="w-28 mx-auto my-4">
      <p class="text-gray-700 text-sm mb-4">
          Dengan berlangganan paket Pro SIMEGA, kamu akan mendapatkan:
          <br>- Chat dengan Roki tanpa batas
          <br>- Lebih banyak tugas yang bisa dibuat
          <br>- Fitur premium lainnya
      </p>
      <a href="{{ route("payment.process")}}" class="border border-blue-500 inline-block w-40 py-2 rounded-full font-bold bg-gradient-to-r from-pink-500 to-blue-500 text-transparent bg-clip-text shadow hover:opacity-90 transition">
          Checkout
      </a>
      <button onclick="closeCheckoutModal()" class="block mt-4 mx-auto hover:underline">Kembali</button>
  </div>
</div>

<!-- Styles dan Scripts -->
@include('chatbot.styles')

<script>
  $(document).ready(function() {
    // Parse markdown content
    document.querySelectorAll('.markdown-content').forEach(function(element) {
      element.innerHTML = marked.parse(element.textContent);
    });

    $("form").submit(function(event) {
      event.preventDefault();
      
      const messageText = $("#message").val().trim();
      if (messageText === '') {
        return;
      }

      // Visual feedback - disable & style form elements
      $("#message").prop('disabled', true)
                   .addClass('bg-gray-100');
      $("form button").prop('disabled', true)
                      .addClass('opacity-60')
                      .removeClass('hover:bg-blue-600');
      
      $(".messages").append(
        '<div class="right message flex justify-end mb-4">' +
        '<p class="bg-blue-300 rounded-lg p-3 max-w-xs">' + messageText + '</p>' +
        '</div>'
      );
      
      // Tambahkan indikator loading/thinking
      const thinkingId = Date.now();
      $(".messages").append(
        '<div id="thinking-' + thinkingId + '" class="left message flex mb-4">' +
        '<img src="/images/roki_avatar.png" alt="Roki avatar" class="w-10 h-10 rounded-full mr-2 self-end">' +
        '<div class="bg-gray-200 rounded-lg p-4 flex items-center thinking">' +
        '<span class="thinking-text">Roki sedang berpikir</span>' +
        '<div class="dot-flashing"></div>' +
        '</div>' +
        '</div>'
      );
      
      $(".messages").scrollTop($(".messages")[0].scrollHeight);
      
      $.ajax({
        url: "/chatbot",
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': "{{csrf_token()}}"
        },
        data: {
          "content": messageText
        }
      }).done(function(res) {
        // Hapus indikator thinking
        $("#thinking-" + thinkingId).remove();
        
        if (res.error && res.message === 'chat_limit_reached') {
          // Tampilkan modal upgrade daripada refresh halaman
          openUpgradeModal();
          return;
        }
        
        const formattedResponse = marked.parse(res);
        
        $(".messages").append(
          '<div class="left message flex mb-4">' +
          '<img src="/images/roki_avatar.png" alt="Roki avatar" class="w-10 h-10 rounded-full mr-2 self-start">' + 
          '<div class="chat-bubble bg-gray-300 rounded-lg p-3 markdown-content">' + formattedResponse + '</div>' +
          '</div>'
        );
        
        $(".messages").scrollTop($(".messages")[0].scrollHeight);
        
        // Update sisa kuota chat jika ada
        updateChatQuota();
        
      }).fail(function(error) {
        // Hapus indikator thinking
        $("#thinking-" + thinkingId).remove();
        
        // Cek jika error karena limit habis
        if (error.status === 403 && error.responseJSON && error.responseJSON.message === 'chat_limit_reached') {
          openUpgradeModal();
          return;
        }
        
        $(".messages").append(
          '<div class="left message flex mb-4">' +
          '<img src="/images/roki_avatar.png" alt="Roki avatar" class="w-10 h-10 rounded-full mr-2 self-end">' +
          '<p class="bg-red-100 rounded-lg p-3 max-w-xs">Maaf, ada kesalahan teknis.</p>' +
          '</div>'
        );
        console.error("Error:", error);
        
      }).always(function() {
        // Kembalikan form ke keadaan normal
        $("#message").prop('disabled', false)
                    .removeClass('bg-gray-100');
        $("form button").prop('disabled', false)
                        .removeClass('opacity-60');
        $("#message").val('').focus();
      });
    });
    
    // Fungsi untuk update kuota chat
    function updateChatQuota() {
      @if(Auth::user()->tier !== 'PRO')
        let chatQuota = {{ Auth::user()->ischatting }} - 1;
        if (chatQuota >= 0) {
          $(".text-right").text("Sisa kuota chat: " + chatQuota);
        }
      @endif
    }
  });
  
  function openUpgradeModal() {
    document.getElementById('upgradeModal').classList.remove('hidden');
  }
  
  function closeUpgradeModal() {
    document.getElementById('upgradeModal').classList.add('hidden');
  }
  
  function openCheckoutModal() {
    document.getElementById('checkoutModal').classList.remove('hidden');
    document.getElementById('upgradeModal').classList.add('hidden');
  }
  
  function closeCheckoutModal() {
    document.getElementById('checkoutModal').classList.add('hidden');
    document.getElementById('upgradeModal').classList.remove('hidden');
  }
</script>

<!-- Tambahkan file styles.blade.php di folder views/chatbot -->
@endsection