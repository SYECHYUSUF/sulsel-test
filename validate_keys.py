
import re
import os
import ast

def load_php_messages(file_path):
    """Simple parser to read PHP array return structure."""
    with open(file_path, 'r', encoding='utf-8') as f:
        content = f.read()
    
    # This is a very basic parser and assumes a clean array structure
    # Robust parsing of PHP with regex is hard, but for this project's clean files it might work
    # Alternatively, we can just grep keys or use a simpler approach.
    # Actually, a better way for this environment might be to just Regex search for keys in the PHP file.
    
    keys = set()
    stack = []
    
    lines = content.splitlines()
    for line in lines:
        line = line.strip()
        # Match 'key' =>
        key_match = re.search(r"'([\w_]+)'\s*=>", line)
        
        # Match array start [
        if line.endswith('['):
            if key_match:
                stack.append(key_match.group(1))
            else:
                # Top level return [
                pass
        
        # Match array end ],
        if line.startswith('],'):
             if stack:
                 stack.pop()
        
        # Match leaf item 'key' => 'value',
        if key_match and not line.endswith('['):
            current_key = key_match.group(1)
            full_key = '.'.join(stack + [current_key])
            keys.add('messages.' + full_key)
            
    return keys

def scan_views_for_keys(views_dir):
    found_keys = {} # key -> file:line
    
    for root, dirs, files in os.walk(views_dir):
        for file in files:
            if file.endswith('.blade.php'):
                path = os.path.join(root, file)
                with open(path, 'r', encoding='utf-8') as f:
                    for i, line in enumerate(f, 1):
                        # Regex to find __('messages.key') or 'messages.key'
                        matches = re.finditer(r"messages\.([a-zA-Z0-9_.]+)", line)
                        for match in matches:
                            key = "messages." + match.group(1)
                            # Remove trailing quotes/brackets if regex over-matched
                            key = key.split("'")[0].split('"')[0]
                            if key not in found_keys:
                                found_keys[key] = []
                            found_keys[key].append(f"{path}:{i}")
    return found_keys

def main():
    php_path = 'lang/id/messages.php'
    views_path = 'resources/views'
    
    print(f"Loading valid keys from {php_path}...")
    valid_keys = load_php_messages(php_path)
    # print(f"Found {len(valid_keys)} valid keys.")
    
    print(f"Scanning views in {views_path}...")
    used_keys = scan_views_for_keys(views_path)
    # print(f"Found {len(used_keys)} unique keys used in views.")
    
    missing_keys = []
    for key, locations in used_keys.items():
        if key not in valid_keys:
            # Filter out some false positives if necessary
            # For now verify strictly
            # Also handle dynamic keys better if needed (e.g. contains $)
            if '$' not in key:
                missing_keys.append((key, locations))
    
    if missing_keys:
        print("\n❌ FOUND MISSING KEYS:")
        for key, locs in missing_keys:
            print(f"Key: {key}")
            for loc in locs[:3]: # Show first 3 locations
                print(f"  - {loc}")
            if len(locs) > 3:
                print(f"  - ... and {len(locs)-3} more")
    else:
        print("\n✅ No missing keys found!")

if __name__ == "__main__":
    main()
