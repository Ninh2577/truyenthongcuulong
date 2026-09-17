import re

with open("resources/views/profile.blade.php", "r", encoding="utf-8") as f:
    content = f.read()

# Replace opening div for Card 1
content = content.replace(
    '<!-- Brand 1: Cuu Long Camping -->\n                    <div class="rounded-2xl bg-surface-container-lowest',
    '<!-- Brand 1: Cuu Long Camping -->\n                    <a href="https://cuulongcamping.vn/" target="_blank" rel="noopener noreferrer" class="block rounded-2xl bg-surface-container-lowest'
)
# Close Card 1
content = content.replace(
    '                        </div>\n                    </div>\n                    <!-- Brand 2: Tui Là Người Miền Tây -->',
    '                        </div>\n                    </a>\n                    <!-- Brand 2: Tui Là Người Miền Tây -->'
)

# Replace opening div for Card 2
content = content.replace(
    '<!-- Brand 2: Tui Là Người Miền Tây -->\n                    <div class="rounded-2xl bg-surface-container-lowest',
    '<!-- Brand 2: Tui Là Người Miền Tây -->\n                    <a href="https://tuilanguoimientay.vn/" target="_blank" rel="noopener noreferrer" class="block rounded-2xl bg-surface-container-lowest'
)
# Close Card 2
content = content.replace(
    '                        </div>\n                    </div>\n                    <!-- Brand 3: Tiêu Dao Tử -->',
    '                        </div>\n                    </a>\n                    <!-- Brand 3: Tiêu Dao Tử -->'
)

# Replace opening div for Card 3
content = content.replace(
    '<!-- Brand 3: Tiêu Dao Tử -->\n                    <div class="rounded-2xl bg-surface-container-lowest',
    '<!-- Brand 3: Tiêu Dao Tử -->\n                    <a href="https://tieudaotu.com/" target="_blank" rel="noopener noreferrer" class="block rounded-2xl bg-surface-container-lowest'
)
# Close Card 3
content = content.replace(
    '                        </div>\n                    </div>\n                    <!-- Brand 4: Cùng Chơi -->',
    '                        </div>\n                    </a>\n                    <!-- Brand 4: Cùng Chơi -->'
)

# Replace opening div for Card 4
content = content.replace(
    '<!-- Brand 4: Cùng Chơi -->\n                    <div class="rounded-2xl bg-surface-container-lowest',
    '<!-- Brand 4: Cùng Chơi -->\n                    <a href="https://cungchoi.com/" target="_blank" rel="noopener noreferrer" class="block rounded-2xl bg-surface-container-lowest'
)
# Close Card 4
content = content.replace(
    '                        </div>\n                    </div>\n                </div>\n            </div>\n        </section>',
    '                        </div>\n                    </a>\n                </div>\n            </div>\n        </section>'
)

with open("resources/views/profile.blade.php", "w", encoding="utf-8") as f:
    f.write(content)

print("Replaced div with a tags.")
