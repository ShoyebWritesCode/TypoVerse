
    <div class="container mx-auto">
        <div class="p-4 max-w-xl mx-auto text">
            <div class="text-xl mb-4 text-center">
                <span class="font-semibold">Typing Test</span>
            </div>

            @if(!$testStarted)
                <div class="flex justify-center">
                    <button wire:click="startTest" class="px-4 py-2 bg-blue-500 text-white rounded">Start</button>
                </div>
            @else
                <div x-data="{
                    timer: @entangle('timer'),
                    input: @entangle('input').defer,
                    words: '{{ implode(' ', $words) }}',
                    showOriginalText: true,
                    wordCount: @entangle('wordCount'),
                    totalInputLength: @entangle('totalInputLength'),
                    totalGreenLength: @entangle('totalGreenLength'),
                    init() {
                        if (this.timer > 0) {
                            this.startTimer();
                        }
                    },
                    startTimer() {
                        let interval = setInterval(() => {
                            if (this.timer > 0) {
                                this.timer--;
                                if (this.timer === 0) {
                                    clearInterval(interval);
                                    @this.endTest();
                                }
                            }
                        }, 1000);
                    },
                    countWords() {
                        this.wordCount = this.input.trim() === '' ? 0 : this.input.trim().split(/\s+/).length;
                        this.totalInputLength = this.input.length;

                        let greenLength = 0;
                        for (let i = 0; i < this.input.length && i < this.words.length; i++) {
                            if (this.words[i] === this.input[i]) {
                                greenLength++;
                            }
                        }
                        this.totalGreenLength = greenLength;
                    },
                    getOriginalText() {
                        return this.words;
                    },
                    getHighlightedText() {
                        let result = '';
                        for (let i = 0; i < this.words.length; i++) {
                            if (i < this.input.length) {
                                result += this.words[i] === this.input[i]
                                    ? `<span class='text-green-500'>${this.words[i]}</span>`
                                    : `<span class='text-red-500'>${this.words[i]}</span>`;
                            } else {
                                result += `<span>${this.words[i]}</span>`;
                            }
                        }
                        return result;
                    },
                }" x-init="init">
                <div x-show="showOriginalText" class="mb-4 p-4 border rounded">
                    <p x-html="getOriginalText()"></p>
                </div>
            
                <div x-show="!showOriginalText" class="mb-4 p-4 border rounded">
                    <p x-html="getHighlightedText()"></p>
                </div>
                    <div class="mb-4">
                        <input x-model="input"
                               x-on:input="countWords"
                               type="text"
                               :disabled="timer <= 0"
                               class="w-full p-2 border rounded opacity-0"
                               placeholder="Start typing here..."
                               autofocus
                               @keydown="showOriginalText = false"
                               x-cloak 
                        >
                    </div>
                    <div class="mt-4">
                        <p><strong>Time Remaining:</strong> <span x-text="timer"></span>s</p>         
                    </div>
                </div>
            @endif

            @if($testEnded)
                <div class="mt-4">
                    <p><strong>Words per minute (WPM):</strong>  {{ number_format($wpm, 2) }}</p>
                    <p><strong>Accuracy:</strong> {{ number_format($accuracy, 2) }}%</p>
                </div>
            @endif
        </div>
    </div>