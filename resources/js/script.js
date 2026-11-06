    
        document.addEventListener('DOMContentLoaded', () => {
            const htmlElement = document.documentElement;
            const themeToggleBtn = document.getElementById('theme-toggle');

            if (!themeToggleBtn) return; 

            
            themeToggleBtn.addEventListener('click', () => {
                
                const currentTheme = htmlElement.getAttribute('data-bs-theme');
                
                
                const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
                
                
                htmlElement.setAttribute('data-bs-theme', newTheme);
                localStorage.setItem('theme', newTheme);
            });
        });
   
//tchat
document.addEventListener('DOMContentLoaded', function () {
const chatButtons = document.querySelectorAll('.chat-toggle-btn');
const chatPanes = document.querySelectorAll('.chat-content-pane');
const welcomeScreen = document.getElementById('chat-welcome-screen');
const backButtons = document.querySelectorAll('.back-to-list-btn');
const listColumn = document.querySelector('.col-12.col-md-4');
const chatColumn = document.querySelector('.col-12.col-md-8');
function updateUrlParameter(chatId) {
const newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?chat=' + chatId;
window.history.pushState({ path: newUrl }, '', newUrl);
}
const urlParams = new URLSearchParams(window.location.search);
const activeChatId = urlParams.get('chat');
if (activeChatId) {
if (welcomeScreen) {
welcomeScreen.classList.remove('d-flex');
welcomeScreen.classList.add('d-none');
}
chatPanes.forEach(pane => pane.classList.replace('d-flex', 'd-none'));
const targetPane = document.getElementById(activeChatId);
if (targetPane) {
targetPane.classList.replace('d-none', 'd-flex');
const messageArea = targetPane.querySelector('.overflow-y-auto');
if (messageArea) messageArea.scrollTop = messageArea.scrollHeight;
}
chatButtons.forEach(btn => {
if (btn.getAttribute('data-chat-target') === activeChatId) {
btn.classList.add('active', 'bg-primary-subtle');

const badge = btn.querySelector('.chat-unread-badge');
if (badge) {
subtractFromNavbar(parseInt(badge.getAttribute('data-unread-count')));
badge.remove();
}
} else {
btn.classList.remove('active', 'bg-primary-subtle');
}
});
if (window.innerWidth < 768) {
listColumn.classList.replace('d-flex', 'd-none');
chatColumn.classList.replace('d-none', 'd-flex');
}
}

function subtractFromNavbar(countToRemove) {
const navbarBadge = document.querySelector('.navbar .badge.bg-danger');
if (navbarBadge) {
const currentCount = parseInt(navbarBadge.innerText.trim());
const newCount = currentCount - countToRemove;
if (newCount <= 0) {
navbarBadge.remove(); 
} else {
navbarBadge.innerText = newCount; 
}
}
}

chatButtons.forEach(btn => {
btn.addEventListener('click', function () {
const targetId = this.getAttribute('data-chat-target');
chatButtons.forEach(b => b.classList.remove('active', 'bg-primary-subtle'));
this.classList.add('active', 'bg-primary-subtle');

const badge = this.querySelector('.chat-unread-badge');
if (badge) {
const unreadCount = parseInt(badge.getAttribute('data-unread-count'));
subtractFromNavbar(unreadCount);
badge.remove();
}

if (welcomeScreen) {
welcomeScreen.classList.remove('d-flex');
welcomeScreen.classList.add('d-none');
}
chatPanes.forEach(pane => pane.classList.replace('d-flex', 'd-none'));
const activePane = document.getElementById(targetId);
if (activePane) {
activePane.classList.replace('d-none', 'd-flex');
const messageArea = activePane.querySelector('.overflow-y-auto');
if (messageArea) messageArea.scrollTop = messageArea.scrollHeight;
}
updateUrlParameter(targetId);

fetch("{{ route('messages.markAsRead') }}", {
method: "POST",
headers: {
"Content-Type": "application/json",
"X-CSRF-TOKEN": "{{ csrf_csrf_token() ?? csrf_token() }}"
},
body: JSON.stringify({ chat: targetId })
})
.then(response => response.json())
.then(data => console.log("Database aggiornato:", data))
.catch(err => console.error("Errore aggiornamento letture:", err));
if (window.innerWidth < 768) {
listColumn.classList.replace('d-flex', 'd-none');
chatColumn.classList.replace('d-none', 'd-flex');
}
});
});
backButtons.forEach(btn => {
btn.addEventListener('click', function () {
listColumn.classList.replace('d-none', 'd-flex');
chatColumn.classList.replace('d-flex', 'd-none');
chatButtons.forEach(b => b.classList.remove('active', 'bg-primary-subtle'));
const cleanUrl = window.location.protocol + "//" + window.location.host + window.location.pathname;
window.history.pushState({ path: cleanUrl }, '', cleanUrl);
});
});
});


//SEARCH BAR
 document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('search-input');
    const searchForm = document.getElementById('search-form');
    let debounceTimer;

    searchInput.addEventListener('input', function () {
      
      clearTimeout(debounceTimer);

      
      const valueLength = searchInput.value.length;

      
      debounceTimer = setTimeout(() => {
        
        const url = new URL(searchForm.action);
        url.searchParams.set('search', searchInput.value);

       
        searchForm.submit();
      }, 300);
    });

    
    if (searchInput.value.length > 0) {
      searchInput.focus();
      searchInput.setSelectionRange(searchInput.value.length, searchInput.value.length);
    }
  });