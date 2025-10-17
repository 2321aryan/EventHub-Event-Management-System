🌐 CORRECT URLs TO ACCESS EVENTHUB:

If your folder is named "event hub" (with space):
✅ http://localhost/event%20hub/
✅ http://localhost/event%20hub/index.php
✅ http://localhost/event%20hub/index.html
✅ http://localhost/event%20hub/setup.php

If your folder is named "eventhub" (no space):
✅ http://localhost/eventhub/
✅ http://localhost/eventhub/index.php
✅ http://localhost/eventhub/index.html

❌ WRONG - Don't use these:
❌ http://localhost/event hub/ (space not encoded)
❌ file:///C:/xampp/htdocs/... (file protocol)

🔧 TROUBLESHOOTING:
1. Make sure XAMPP Apache is running (green status)
2. Files should be in: C:\xampp\htdocs\event hub\
3. Always use http://localhost/ not file:///

🚀 START HERE:
http://localhost/event%20hub/index.php