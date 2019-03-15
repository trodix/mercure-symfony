const url = new URL('http://localhost:3000/hub');
url.searchParams.append('topic', 'http://localhost:8000/books/{user_id}/{book_id}'); // sujet à écouter

const eventSource = new EventSource(url);

// The callback will be called every time an update is published
eventSource.onmessage = e => console.log(e); // do something with the payload

const es = new EventSource('http://localhost:3000/hub?topic=' + encodeURIComponent('http://localhost:8000/books/{user_id}/{book_id}'), {withCredentials: true});
es.onmessage = e => {
    // Will be called every time an update is published by the server
    console.log(JSON.parse(e.data));
    const data = JSON.parse(e.data);
    if(data.status) {
        document.querySelector('#output').classList = ['alert alert-primary'];
        document.querySelector('#output').innerHTML = `Book id: ${data.id}, Book status: ${data.status}`;
    }
};



document.querySelector("#getBook").addEventListener('click', e => {
    e.preventDefault();

    let user_id = document.querySelector('#user-id').value;
    let book_id = document.querySelector('#book-id').value;

    const init = { 
        method: 'POST',
        mode: 'no-cors',
        withCredentials: true,
        credentials: 'include',
        headers: {
            'Authorization': "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJtZXJjdXJlIjp7InB1Ymxpc2giOlsiKiJdfX0.NFCEbEEiI7zUxDU2Hj0YB71fQVT8YiQBGQWEyxWG0po",
        }
    };

    fetch(`http://localhost:8000/books/${user_id}/${book_id}`, init);
});