// 17 - Challenge: Complete project using all TypeScript features

// Basic Types
const gameName: string = "Hollow Knight";
const maxHealth: number = 100;
const isBoss: boolean = false;
const skills: string[] = ["Dash", "Double Jump", "Crystal Heart"];
const position: [number, number] = [0, 0];
const dynamicValue: any = "Special Ability";

// Interfaces
interface Character {
    name: string;
    health: number;
    skills: string[];
    position: [number, number];
    takeDamage(damage: number): void;
    heal(amount: number): void;
}

interface Item {
    name: string;
    type: ItemType;
    effect: string;
}

// Enums
enum ItemType {
    Charm = "Charm",
    Weapon = "Weapon",
    Potion = "Potion"
}

enum GameState {
    Menu,
    Playing,
    Paused,
    GameOver
}

// Advanced Types
type GameItem = Item & { rarity: "Common" | "Rare" | "Legendary" };
type OptionalCharacter = Partial<Character>;
type ReadonlyCharacter = Readonly<Character>;

// Utility Types
type PickedItem = Pick<Item, "name" | "type">;
type OmittedItem = Omit<Item, "effect">;

// Functions
function calculateDamage(baseDamage: number, multiplier: number): number {
    return baseDamage * multiplier;
}

function isAlive(health: number): boolean {
    return health > 0;
}

// Generics
class GameInventory<T> {
    private items: T[] = [];

    addItem(item: T): void {
        this.items.push(item);
    }

    getItems(): T[] {
        return this.items;
    }

    removeItem(index: number): T | undefined {
        return this.items.splice(index, 1)[0];
    }
}

// Classes
class GameCharacter implements Character {
    name: string;
    health: number;
    skills: string[];
    position: [number, number];
    inventory: GameInventory<GameItem>;

    constructor(name: string, health: number, skills: string[], position: [number, number]) {
        this.name = name;
        this.health = health;
        this.skills = skills;
        this.position = position;
        this.inventory = new GameInventory<GameItem>();
    }

    takeDamage(damage: number): void {
        this.health -= damage;
        if (this.health < 0) this.health = 0;
    }

    heal(amount: number): void {
        this.health += amount;
        if (this.health > maxHealth) this.health = maxHealth;
    }

    useSkill(skillIndex: number): string {
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
    const fightBtn = document.getElementById('fightBtn') as HTMLButtonElement;
    if (output17) {
        output17.innerHTML = `
            <li><strong>Player:</strong> ${player.name} - Health: ${player.health}/${maxHealth}</li>
            <li><strong>Enemy:</strong> ${enemy.name} - Health: ${enemy.health}/80</li>
        `;
    }
    if (message) {
        if (player.health <= 0) {
            message.textContent = "¡El enemigo gana!";
            if (fightBtn) fightBtn.disabled = true;
        } else if (enemy.health <= 0) {
            message.textContent = "¡El jugador gana!";
            if (fightBtn) fightBtn.disabled = true;
        } else {
            message.textContent = "";
            if (fightBtn) fightBtn.disabled = false;
        }
    }
}

// Decorators
function Logger(target: any, propertyKey: string, descriptor: PropertyDescriptor) {
    const originalMethod = descriptor.value;
    descriptor.value = function (...args: any[]) {
        console.log(`Calling ${propertyKey} with args:`, args);
        const result = originalMethod.apply(this, args);
        console.log(`Result:`, result);
        return result;
    };
}

function ReadOnly(target: any, propertyKey: string) {
    Object.defineProperty(target, propertyKey, { writable: false });
}

// Namespaces
namespace GameUtils {
    export function formatPosition(pos: [number, number]): string {
        return `(${pos[0]}, ${pos[1]})`;
    }

    export function randomDamage(): number {
        return Math.floor(Math.random() * 20) + 1;
    }
}

// Type Guards
function isGameItem(obj: any): obj is GameItem {
    return obj && typeof obj.name === 'string' && typeof obj.type === 'string' && typeof obj.effect === 'string' && typeof obj.rarity === 'string';
}

// Mixins
type Constructor<T = {}> = new (...args: any[]) => T;

function Timestamped<T extends Constructor>(Base: T) {
    return class extends Base {
        createdAt = new Date();
    };
}

function Named<T extends Constructor>(Base: T) {
    return class extends Base {
        displayName: string = "Game Entity";
    };
}

// Async/Await and Promises
async function simulateBattle(character: any): Promise<string> {
    return new Promise((resolve, reject) => {
        setTimeout(() => {
            const damage = GameUtils.randomDamage();
            character.takeDamage(damage);
            if (character.health > 0) {
                resolve(`Battle won! Took ${damage} damage. Health: ${character.health}`);
            } else {
                reject(new Error("Character defeated"));
            }
        }, 1000);
    });
}

// Error Handling
function safeBattle(character: GameCharacter): void {
    try {
        simulateBattle(character).then(result => {
            console.log(result);
        }).catch(error => {
            console.error("Battle error:", error.message);
        });
    } catch (error: any) {
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
const fightBtn = document.getElementById('fightBtn') as HTMLButtonElement;
const restartBtn = document.getElementById('restartBtn') as HTMLButtonElement;

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
