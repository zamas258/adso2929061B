// 07 - Advanced Types: uso de unión e intersección de tipos

type BookInfo = { title: string; author: string };
type Inventory = { copies: number };
type LibraryItem = BookInfo & Inventory;
type Condition = "New" | "Used";

const item: LibraryItem = { title: "1984", author: "George Orwell", copies: 5 };
const availability: Condition = "New";

// Display in browser
const output07 = document.getElementById('output07');
if (output07) {
    output07.innerHTML = `
        <li><strong>Title:</strong> ${item.title}</li>
        <li><strong>Author:</strong> ${item.author}</li>
        <li><strong>Copies:</strong> ${item.copies}</li>
        <li><strong>Condition:</strong> ${availability}</li>
    `;
}

// 08 - Decorators: decoradores de clase y método

function Logger(constructor: Function) {
    console.log('Class created:', constructor.name);
}

function ReadOnly(target: any, key: string) {
    Object.defineProperty(target, key, { writable: false });
}

@Logger
class Library {
    @ReadOnly
    name: string = "City Library";
    
    constructor(public books: number) {}
    
    info(): string {
        return `${this.name} has ${this.books} books`;
    }
}

const library = new Library(500);

const output08 = document.getElementById('output08');
if (output08) {
    output08.innerHTML = `
        <li><strong>Library:</strong> ${library.info()}</li>
        <li><strong>Name:</strong> ${library.name}</li>
        <li><strong>Books:</strong> ${library.books}</li>
    `;
}