
<div class="bg-gray-50 border border-gray-200 rounded-lg p-4 flex items-center justify-between mb-6 shadow-sm">
    <div>
        <p class="text-sm font-medium text-gray-500 mb-1">Class code</p>
        <div id="class-code-value-{{ $code }}"
            class="text-3xl sm:text-4xl font-bold text-blue-700 tracking-wide select-text">
            {{ $code }}
        </div>
    </div>
    <div class="relative">
        <button id="copy-code-button-{{ $code }}"
            class="p-2 ml-4 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition duration-150 ease-in-out"
            title="Copy class code">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 0h-3M16 16v.01M6 16v.01">
                </path>
            </svg>
        </button>

        <span id="copied-feedback-{{ $code }}"
            class="absolute top-1/2 right-full -translate-y-1/2 mr-2 px-3 py-1 bg-green-500 text-white text-xs rounded-md shadow-md whitespace-nowrap transition ease-out duration-100 transform scale-90 opacity-0"
            style="display: none;" {{-- Explicitly hidden by default --}}>
            Copied!
        </span>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const copyButton = document.getElementById('copy-code-button-{{ $code }}');
        const classCodeValue = document.getElementById('class-code-value-{{ $code }}');
        const copiedFeedback = document.getElementById('copied-feedback-{{ $code }}');

        if (copyButton && classCodeValue && copiedFeedback) {
            copyButton.addEventListener('click', function() {
                const codeToCopy = classCodeValue.textContent.trim();

                // Use the Clipboard API
                navigator.clipboard.writeText(codeToCopy)
                    .then(() => {
                        // Show feedback with transition
                        copiedFeedback.style.display = 'block';
                        setTimeout(() => {
                            copiedFeedback.classList.remove('scale-90', 'opacity-0');
                            copiedFeedback.classList.add('scale-100', 'opacity-100');
                        }, 10); // Small delay to allow display block to register

                        // Hide feedback after 2 seconds
                        setTimeout(() => {
                            copiedFeedback.classList.remove('scale-100', 'opacity-100');
                            copiedFeedback.classList.add('scale-90', 'opacity-0');
                            setTimeout(() => {
                                copiedFeedback.style.display = 'none';
                            }, 100); // Wait for transition to complete before hiding
                        }, 2000);
                    })
                    .catch(err => {
                        console.error('Failed to copy text: ', err);
                        alert('Could not copy the code. Please try again or copy manually.');
                    });
            });
        }
    });
</script>

