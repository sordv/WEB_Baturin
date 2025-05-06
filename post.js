async function fetchPost(id) {
    try {
        const response = await fetch(`https://jsonplaceholder.typicode.com/posts/${id}`)
        if (!response.ok) { throw new Error('Request failed with status ', response.status) }
        return await response.json()
    } catch (error) {
        console.error('Fetching post failed with:', error)
        return null
    }
}

async function fetchComments(postId) {
    try {
        const response = await fetch(`https://jsonplaceholder.typicode.com/posts/${postId}/comments`)
        if (!response.ok) { throw new Error('Request failed with status ', response.status) }
        return await response.json()
    } catch (error) {
        console.error('Fetching comments failed with:', error)
        return []
    }
}

function renderPost(post) {
    if (!post) { return '<div class="error">Post not found</div>' }

    return `
    <h2>Post:</h2>
        <div class="post-item">
            <h2 class="post-item__title">${post.title}</h2>
            <p class="post-item__body">${post.body}</p>
        </div>
    `
}

function renderComments(comments) {
    if (comments.length === 0) { return '<div>Comments not found</div>' }

    return `
        <div class="comments">
            <h3>Comments:</h3>
            ${comments.map(comment => `
                <div class="comment">
                    <h4 class="comment-name">${comment.name}</h4>
                    <p class="comment-email"><a href="mailto:${comment.email}">${comment.email}</a></p>
                    <p class="comment-body">${comment.body}</p>
                </div>
            `).join('')}
        </div>
    `
}

async function init() {
    const urlParams = new URLSearchParams(window.location.search)
    const postId = urlParams.get('id')

    if (!postId) {
        document.getElementById('post-details').innerHTML = '<div class="error">Invalid post ID</div>'
        return
    }

    const post = await fetchPost(postId)
    document.getElementById('post-details').innerHTML = renderPost(post)

    const comments = await fetchComments(postId)
    document.getElementById('post-comments').innerHTML = renderComments(comments)
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init)
} else {
    init()
}