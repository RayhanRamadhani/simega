<style>
  .thinking {
    display: flex;
    align-items: center;
  }

  .thinking-text {
    margin-right: 12px; /* Tambah margin lebih besar */
  }

  .dot-flashing {
    position: relative;
    width: 10px;
    height: 10px;
    border-radius: 5px;
    background-color: #FF00BF;
    color: #FF00BF;
    animation: dot-flashing 1s infinite linear alternate;
    animation-delay: 0s;
    margin-left: 5px; /* Tambah margin */
  }
  
  .dot-flashing::before, .dot-flashing::after {
    content: '';
    display: inline-block;
    position: absolute;
    top: 0;
  }
  .dot-flashing::before {
    left: -15px;
    width: 10px;
    height: 10px;
    border-radius: 5px;
    background-color: #067AFF;
    color: #067AFF;
    animation: dot-flashing 1s infinite alternate;
    animation-delay: 0.5s;
  }
  .dot-flashing::after {
    left: 15px;
    width: 10px;
    height: 10px;
    border-radius: 5px;
    background-color: #FF00BF;
    color: #FF00BF;
    animation: dot-flashing 1s infinite alternate;
    animation-delay: 1s;
  }

  @keyframes dot-flashing {
    0% { background-color: #067AFF; }
    50%, 100% { background-color: rgba(152, 128, 255, 0.2); }
  }
  
  .markdown-content pre {
    background: #f4f4f4;
    border: 1px solid #ddd;
    border-radius: 3px;
    padding: 10px;
    overflow-x: auto;
  }
  
  .markdown-content code {
    font-family: monospace;
  }
</style>