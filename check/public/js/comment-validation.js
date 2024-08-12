document.getElementById('submit').addEventListener('submit', (event) => {
    const message = document.getElementById('message').value;

    // Check si balise script mais tres basique
    const scriptPattern = /<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/gi;
    if (scriptPattern.test(message)) {
        alert('Les scripts ne sont pas autorisés dans le message.');
        event.preventDefault();
    }
});