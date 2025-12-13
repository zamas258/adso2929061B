"use strict";
// 17 - Challenge: Complete project using all TypeScript features
// Basic Types
const gameName = "Hollow Knight";
const maxHealth = 100;
const isBoss = false;
const skills = ["Dash", "Double Jump", "Crystal Heart"];
const position = [0, 0];
const dynamicValue = "Special Ability";
// Enums
var ItemType;
(function (ItemType) {
    ItemType["Charm"] = "Charm";
    ItemType["Weapon"] = "Weapon";
    ItemType["Potion"] = "Potion";
})(ItemType || (ItemType = {}));
var GameState;
(function (GameState) {
    GameState[GameState["Menu"] = 0] = "Menu";
    GameState[GameState["Playing"] = 1] = "Playing";
    GameState[GameState["Paused"] = 2] = "Paused";
    GameState[GameState["GameOver"] = 3] = "GameOver";
})(GameState || (GameState = {}));
// Functions
function calculateDamage(baseDamage, multiplier) {
    return baseDamage * multiplier;
}
function isAlive(health) {
    return health > 0;
}
// Generics
class GameInventory {
    constructor() {
        this.items = [];
    }
    addItem(item) {
        this.items.push(item);
    }
    getItems() {
        return this.items;
    }
    removeItem(index) {
        return this.items.splice(index, 1)[0];
    }
}
// Classes
class GameCharacter {
    constructor(name, health, skills, position) {
        this.name = name;
        this.health = health;
        this.skills = skills;
        this.position = position;
        this.inventory = new GameInventory();
    }
    takeDamage(damage) {
        this.health -= damage;
        if (this.health < 0)
            this.health = 0;
    }
    heal(amount) {
        this.health += amount;
        if (this.health > maxHealth)
            this.health = maxHealth;
    }
    useSkill(skillIndex) {
        if (skillIndex < this.skills.length) {
            return `Used skill: ${this.skills[skillIndex]}`;
        }
        return "Skill not found";
    }
}
// Function to update the display
function updateDisplay() {
    const output17 = document.getElementById('output17');
    const message = document.getElementById('message');
    const fightBtn = document.getElementById('fightBtn');
    if (output17) {
        output17.innerHTML = `
            <li><strong>Player:</strong> ${player.name} - Health: ${player.health}/${maxHealth}</li>
            <li><strong>Enemy:</strong> ${enemy.name} - Health: ${enemy.health}/80</li>
        `;
    }
    if (message) {
        if (player.health <= 0) {
            message.textContent = "¡El enemigo gana!";
            if (fightBtn)
                fightBtn.disabled = true;
        }
        else if (enemy.health <= 0) {
            message.textContent = "¡El jugador gana!";
            if (fightBtn)
                fightBtn.disabled = true;
        }
        else {
            message.textContent = "";
            if (fightBtn)
                fightBtn.disabled = false;
        }
    }
}
// Decorators
function Logger(target, propertyKey, descriptor) {
    const originalMethod = descriptor.value;
    descriptor.value = function (...args) {
        console.log(`Calling ${propertyKey} with args:`, args);
        const result = originalMethod.apply(this, args);
        console.log(`Result:`, result);
        return result;
    };
}
function ReadOnly(target, propertyKey) {
    Object.defineProperty(target, propertyKey, { writable: false });
}
// Namespaces
var GameUtils;
(function (GameUtils) {
    function formatPosition(pos) {
        return `(${pos[0]}, ${pos[1]})`;
    }
    GameUtils.formatPosition = formatPosition;
    function randomDamage() {
        return Math.floor(Math.random() * 20) + 1;
    }
    GameUtils.randomDamage = randomDamage;
})(GameUtils || (GameUtils = {}));
// Type Guards
function isGameItem(obj) {
    return obj && typeof obj.name === 'string' && typeof obj.type === 'string' && typeof obj.effect === 'string' && typeof obj.rarity === 'string';
}
function Timestamped(Base) {
    return class extends Base {
        constructor() {
            super(...arguments);
            this.createdAt = new Date();
        }
    };
}
function Named(Base) {
    return class extends Base {
        constructor() {
            super(...arguments);
            this.displayName = "Game Entity";
        }
    };
}
// Async/Await and Promises
async function simulateBattle(character) {
    return new Promise((resolve, reject) => {
        setTimeout(() => {
            const damage = GameUtils.randomDamage();
            character.takeDamage(damage);
            if (character.health > 0) {
                resolve(`Battle won! Took ${damage} damage. Health: ${character.health}`);
            }
            else {
                reject(new Error("Character defeated"));
            }
        }, 1000);
    });
}
// Error Handling
function safeBattle(character) {
    try {
        simulateBattle(character).then(result => {
            console.log(result);
        }).catch(error => {
            console.error("Battle error:", error.message);
        });
    }
    catch (error) {
        console.error("Unexpected error:", error.message);
    }
}
// Modules (simulated with exports)
// export { GameCharacter, GameInventory, ItemType, GameState };
// Main execution
const player = new GameCharacter("The Knight", maxHealth, skills, position);
const enemy = new GameCharacter("Hornet", 80, ["Needle", "Dash"], [5, 5]);
// Add items to inventory
player.inventory.addItem({ name: "Mothwing Cloak", type: ItemType.Charm, effect: "Dash ability", rarity: "Rare" });
player.inventory.addItem({ name: "Crystal Heart", type: ItemType.Charm, effect: "Super Dash", rarity: "Legendary" });
// Use mixins
const EnhancedCharacter = Named(Timestamped(GameCharacter));
const enhancedPlayer = new EnhancedCharacter("Enhanced Knight", 120, ["Dash", "Super Dash"], [10, 10]);
// Display in browser
updateDisplay();
// Add event listeners for buttons
const fightBtn = document.getElementById('fightBtn');
const restartBtn = document.getElementById('restartBtn');
if (fightBtn) {
    fightBtn.addEventListener('click', () => {
        if (player.health > 0 && enemy.health > 0) {
            enemy.takeDamage(10); // Player attacks enemy
            player.takeDamage(5); // Enemy attacks player
            updateDisplay();
        }
    });
}
if (restartBtn) {
    restartBtn.addEventListener('click', () => {
        player.health = maxHealth;
        enemy.health = 80;
        updateDisplay();
    });
}
