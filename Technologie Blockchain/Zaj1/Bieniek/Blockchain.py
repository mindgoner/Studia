import hashlib
import json
import time
from flask import Flask, request, jsonify

class Blockchain:
    def __init__(self):
        self.BB_chain = []
        self.nonce = 0
        self.total_bitcoins = 0
        self.bitcoin_limit = 21_000_000
        self.initial_reward = 50
        self.halving_interval = 210_000
        self.BB_create_block(previous_hash="Bieniek", nonce=self.nonce)

    def BB_create_block(self, previous_hash, nonce):
        block = {
            'index': len(self.BB_chain) + 1,
            'timestamp': time.time(),
            'previous_hash': previous_hash,
            'nonce': nonce,
            'reward': 0
        }
        block['hash'] = self.BB_hash(block)
        self.BB_chain.append(block)
        return block

    def BB_hash(self, block):
        block_string = json.dumps({k: block[k] for k in block if k != 'hash'}, sort_keys=True).encode()
        return hashlib.sha256(block_string).hexdigest()

    def get_current_reward(self):
        halvings = len(self.BB_chain) // self.halving_interval
        reward = self.initial_reward / (2 ** halvings)
        return max(0, reward)

    def BB_add_block(self):
        previous_block = self.BB_chain[-1]
        nonce = self.nonce
        while True:
            new_block = {
                'index': len(self.BB_chain) + 1,
                'timestamp': time.time(),
                'previous_hash': previous_block['hash'],
                'nonce': nonce,
                'reward': 0
            }
            block_hash = self.BB_hash(new_block)
            if block_hash.endswith("00001"):
                current_reward = self.get_current_reward()
                if self.total_bitcoins + current_reward <= self.bitcoin_limit:
                    self.total_bitcoins += current_reward
                    new_block['reward'] = current_reward
                else:
                    new_block['reward'] = 0  # Nie przyznajemy nagrody, jeśli przekroczymy limit
                new_block['hash'] = block_hash
                self.BB_chain.append(new_block)
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

@app.route('/wallet', methods=['GET'])
def wallet():
    return jsonify({
        "total_bitcoins_mined": blockchain.total_bitcoins,
        "bitcoin_limit": blockchain.bitcoin_limit,
        "remaining": blockchain.bitcoin_limit - blockchain.total_bitcoins,
        "remaining_percent": (blockchain.bitcoin_limit - blockchain.total_bitcoins) / blockchain.bitcoin_limit * 100,
        "current_reward_per_block": blockchain.get_current_reward()
    }), 200

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000)
