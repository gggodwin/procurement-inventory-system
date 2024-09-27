<!-- Page loader -->
<style>
    body {
    margin: 0;
    padding: 0;
    width: 100vw;
    height: 100vh;
    background-color: #eee;
    position: relative; /* Ensure the body is the reference point for absolute positioning */
}

.content {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 100%;
}

.loader-wrapper {
    width: 100%;
    height: 100%;
    position: fixed; /* Use fixed positioning to ensure it stays in place */
    top: 0;
    left: 0;
    background-color: #242f3f;
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999; /* Ensure the loader is on top */
}

.loader {
    display: flex;
    font-family: Arial, sans-serif;
    font-size: 40px;
    font-weight: bold;
    color: #fff;
}

.loader span {
    display: inline-block;
    opacity: 0;
    animation: fadeInOut 1.5s infinite;
}

.loader span:nth-child(1) { animation-delay: 0s; }
.loader span:nth-child(2) { animation-delay: 0.1s; }
.loader span:nth-child(3) { animation-delay: 0.2s; }
.loader span:nth-child(4) { animation-delay: 0.3s; }
.loader span:nth-child(5) { animation-delay: 0.4s; }
.loader span:nth-child(6) { animation-delay: 0.5s; }
.loader span:nth-child(7) { animation-delay: 0.6s; }
.loader span:nth-child(8) { animation-delay: 0.7s; }

@keyframes fadeInOut {
    0%, 100% { opacity: 0; }
    50% { opacity: 1; }
}

</style>
<div class="loader-wrapper">
        <div class="loader">
            <span>i</span>
            <span>n</span>
            <span>v</span>
            <span>e</span>
            <span>x</span>
            <span>y</span>
            <span>s</span>
        </div>
</div>