// function loadContent(page) {
//   fetch(`../partials/${page}.php`)
//     .then(response => response.text())
//     .then(html => {
//       document.getElementById('dynamic-content').innerHTML = html;

//       // Update breadcrumb
//       const breadcrumb = document.querySelector('.breadcrumb');
//       breadcrumb.innerHTML = `
//         <li class="breadcrumb-item"><a href="#" onclick="loadContent('dashboard')">Home</a></li>
//         <li class="breadcrumb-item active">${page.replace('-', ' ')}</li>
//       `;

//       // Update judul halaman
//       document.querySelector('.app-content-header h3').textContent =
//         page.replace('-', ' ').toUpperCase();
//     })
//     .catch(error => console.error('Error:', error));
// }

// // Load dashboard saat pertama kali buka
// document.addEventListener('DOMContentLoaded', () => {
//   loadContent('dashboard');
// });
