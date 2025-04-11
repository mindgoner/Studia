import hashlib
import json
import time
from flask import Flask, request, jsonify

class Blockchain:
    def __init__(self):
        self.BB_chain = []
        self.nonce = 58085
        self.BB_create_block(previous_hash="Bieniek", nonce=self.nonce)

    def BB_create_block(self, previous_hash, nonce):
        block = {
            'index': len(self.BB_chain) + 1,
            'timestamp': time.time(),
            'previous_hash': previous_hash,
            'nonce': nonce
        }
        block['hash'] = self.BB_hash(block)
        self.BB_chain.append(block)
        return block

    def BB_hash(self, block):
        block_string = json.dumps(block, sort_keys=True).encode()
        return hashlib.sha256(block_string).hexdigest()

    def BB_add_block(self):
        previous_block = self.BB_chain[-1]
        nonce = self.nonce
        while True:
            new_block = self.BB_create_block(previous_block['hash'], nonce)
            if new_block['hash'].endswith("001"):
                return new_block
            nonce += 1

app = Flask(__name__)
blockchain = Blockchain()

@app.route('/mine', methods=['GET'])
def mine():
    new_block = blockchain.BB_add_block()
    return jsonify(new_block), 200

@app.route('/chain', methods=['GET'])
def get_chain():
    return jsonify(blockchain.BB_chain), 200

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000)

