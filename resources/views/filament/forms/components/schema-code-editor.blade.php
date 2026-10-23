<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    <div 
        x-data="{
            code: $wire.$entangle('{{ $getStatePath() }}'),
            copied: false,
            formatJson() {
                try {
                    if (!this.code || !this.code.trim()) return;
                    const parsed = JSON.parse(this.code);
                    this.code = JSON.stringify(parsed, null, 2);
                } catch (e) {
                    alert('Mã JSON chưa đúng cú pháp: ' + e.message);
                }
            },
            copyCode() {
                if (!this.code) return;
                navigator.clipboard.writeText(this.code);
                this.copied = true;
                setTimeout(() => this.copied = false, 2000);
            },
            loadTemplate(type) {
                let sample = {};
                if (type === 'service') {
                    sample = {
                        '@type': 'Service',
                        '@id': 'https://truyenthongcuulong.com/#service-page',
                        'name': 'Dịch Vụ Thiết Kế Website Chuẩn SEO',
                        'description': 'Mô tả chi tiết dịch vụ chuyên nghiệp...',
                        'serviceType': 'Thiết kế website & Lập trình ứng dụng',
                        'provider': {
                            '@id': 'https://truyenthongcuulong.com/#organization'
                        },
                        'areaServed': [
                            { '@type': 'City', 'name': 'Cần Thơ' },
                            { '@type': 'AdministrativeArea', 'name': 'Đồng bằng sông Cửu Long' }
                        ]
                    };
                } else if (type === 'webpage') {
                    sample = {
                        '@type': 'WebPage',
                        'name': 'Tiêu đề trang chuyên đề',
                        'description': 'Mô tả nội dung trang...',
                        'inLanguage': 'vi',
                        'isPartOf': {
                            '@id': 'https://truyenthongcuulong.com/#website'
                        }
                    };
                } else if (type === 'faq') {
                    sample = {
                        '@type': 'FAQPage',
                        'mainEntity': [
                            {
                                '@type': 'Question',
                                'name': 'Quy trình thực hiện dịch vụ thế nào?',
                                'acceptedAnswer': {
                                    '@type': 'Answer',
                                    'text': 'Chúng tôi tiếp nhận yêu cầu, tư vấn giải pháp và bàn giao hoàn chỉnh.'
                                }
                            }
                        ]
                    };
                }
                this.code = JSON.stringify(sample, null, 2);
            },
            clearCode() {
                if (confirm('Bạn có chắc muốn xóa trắng mã Schema?')) {
                    this.code = '';
                }
            },
            handleKeyDown(e) {
                if (e.key === 'Tab') {
                    e.preventDefault();
                    const start = e.target.selectionStart;
                    const end = e.target.selectionEnd;
                    this.code = (this.code || '').substring(0, start) + '  ' + (this.code || '').substring(end);
                    this.$nextTick(() => {
                        e.target.selectionStart = e.target.selectionEnd = start + 2;
                    });
                }
            }
        }"
        class="cl-schema-ide"
    >
        <style>
            .cl-schema-ide {
                border-radius: 14px !important;
                background: #0f172a !important;
                border: 1px solid #334155 !important;
                box-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.4), 0 8px 10px -6px rgba(15, 23, 42, 0.2) !important;
                overflow: hidden !important;
                font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif !important;
                transition: border-color 0.2s ease, box-shadow 0.2s ease !important;
            }
            .cl-schema-ide:focus-within {
                border-color: #ff5e14 !important;
                box-shadow: 0 0 0 1px #ff5e14, 0 12px 28px -5px rgba(255, 94, 20, 0.25) !important;
            }
            .cl-schema-header {
                background: #1e293b !important;
                padding: 10px 16px !important;
                display: flex !important;
                align-items: center !important;
                justify-content: space-between !important;
                gap: 12px !important;
                border-bottom: 1px solid #334155 !important;
                flex-wrap: wrap !important;
            }
            .cl-mac-dots {
                display: flex !important;
                align-items: center !important;
                gap: 7px !important;
            }
            .cl-mac-dot {
                width: 11px !important;
                height: 11px !important;
                border-radius: 50% !important;
                display: inline-block !important;
                box-shadow: inset 0 1px 1px rgba(255, 255, 255, 0.3) !important;
            }
            .cl-mac-dot.red { background: #ef4444 !important; }
            .cl-mac-dot.yellow { background: #f59e0b !important; }
            .cl-mac-dot.green { background: #10b981 !important; }

            .cl-schema-tab {
                display: inline-flex !important;
                align-items: center !important;
                gap: 8px !important;
                padding: 4px 10px !important;
                background: #0f172a !important;
                border: 1px solid #334155 !important;
                border-radius: 8px !important;
                font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace !important;
                font-size: 12px !important;
                color: #e2e8f0 !important;
            }
            .cl-schema-tab .bracket {
                color: #ff5e14 !important;
                font-weight: 700 !important;
            }
            .cl-schema-tab .filename {
                font-weight: 600 !important;
                color: #f1f5f9 !important;
            }
            .cl-schema-tab .badge {
                font-size: 10px !important;
                text-transform: uppercase !important;
                font-weight: 700 !important;
                letter-spacing: 0.05em !important;
                padding: 2px 7px !important;
                border-radius: 4px !important;
                background: rgba(255, 94, 20, 0.15) !important;
                color: #ff7a3d !important;
                border: 1px solid rgba(255, 94, 20, 0.3) !important;
            }

            .cl-schema-tools {
                display: flex !important;
                align-items: center !important;
                gap: 6px !important;
                flex-wrap: wrap !important;
            }
            .cl-schema-label {
                font-size: 11.5px !important;
                font-weight: 500 !important;
                color: #94a3b8 !important;
                margin-right: 2px !important;
            }
            .cl-schema-btn {
                display: inline-flex !important;
                align-items: center !important;
                gap: 5px !important;
                padding: 5px 11px !important;
                border-radius: 7px !important;
                font-size: 11.5px !important;
                font-weight: 600 !important;
                cursor: pointer !important;
                border: 1px solid transparent !important;
                transition: all 0.15s ease !important;
                user-select: none !important;
                line-height: 1.2 !important;
                text-decoration: none !important;
            }
            .cl-schema-btn:hover {
                transform: translateY(-1px) !important;
            }
            .cl-schema-btn:active {
                transform: translateY(0) !important;
            }
            .cl-schema-btn.btn-sky {
                background: rgba(14, 165, 233, 0.15) !important;
                color: #38bdf8 !important;
                border-color: rgba(14, 165, 233, 0.35) !important;
            }
            .cl-schema-btn.btn-sky:hover {
                background: rgba(14, 165, 233, 0.25) !important;
                border-color: rgba(14, 165, 233, 0.6) !important;
                color: #bae6fd !important;
            }
            .cl-schema-btn.btn-slate {
                background: rgba(148, 163, 184, 0.12) !important;
                color: #cbd5e1 !important;
                border-color: rgba(148, 163, 184, 0.3) !important;
            }
            .cl-schema-btn.btn-slate:hover {
                background: rgba(148, 163, 184, 0.22) !important;
                border-color: rgba(148, 163, 184, 0.5) !important;
                color: #f8fafc !important;
            }
            .cl-schema-btn.btn-emerald {
                background: rgba(16, 185, 129, 0.15) !important;
                color: #34d399 !important;
                border-color: rgba(16, 185, 129, 0.35) !important;
            }
            .cl-schema-btn.btn-emerald:hover {
                background: rgba(16, 185, 129, 0.25) !important;
                border-color: rgba(16, 185, 129, 0.6) !important;
                color: #a7f3d0 !important;
            }
            .cl-schema-btn.btn-amber {
                background: rgba(245, 158, 11, 0.15) !important;
                color: #fbbf24 !important;
                border-color: rgba(245, 158, 11, 0.35) !important;
            }
            .cl-schema-btn.btn-amber:hover {
                background: rgba(245, 158, 11, 0.25) !important;
                border-color: rgba(245, 158, 11, 0.6) !important;
                color: #fef08a !important;
            }
            .cl-schema-btn.btn-rose {
                background: rgba(239, 68, 68, 0.15) !important;
                color: #f87171 !important;
                border-color: rgba(239, 68, 68, 0.35) !important;
            }
            .cl-schema-btn.btn-rose:hover {
                background: rgba(239, 68, 68, 0.25) !important;
                border-color: rgba(239, 68, 68, 0.6) !important;
                color: #fecaca !important;
            }
            .cl-schema-divider {
                width: 1px !important;
                height: 18px !important;
                background: #334155 !important;
                margin: 0 4px !important;
            }

            .cl-schema-body {
                position: relative !important;
                background: #090d16 !important;
            }
            .cl-schema-textarea {
                display: block !important;
                box-sizing: border-box !important;
                width: 100% !important;
                min-height: 380px !important;
                max-height: 700px !important;
                padding: 16px 20px !important;
                background: #090d16 !important;
                color: #38bdf8 !important;
                font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace !important;
                font-size: 13px !important;
                line-height: 1.7 !important;
                white-space: pre !important;
                tab-size: 2 !important;
                border: none !important;
                outline: none !important;
                resize: vertical !important;
                box-shadow: none !important;
                caret-color: #ff5e14 !important;
            }
            .cl-schema-textarea::placeholder {
                color: #475569 !important;
            }
            .cl-schema-textarea::-webkit-scrollbar {
                width: 8px;
                height: 8px;
            }
            .cl-schema-textarea::-webkit-scrollbar-track {
                background: #090d16;
            }
            .cl-schema-textarea::-webkit-scrollbar-thumb {
                background: #1e293b;
                border-radius: 4px;
            }
            .cl-schema-textarea::-webkit-scrollbar-thumb:hover {
                background: #334155;
            }

            .cl-schema-footer {
                background: #111827 !important;
                padding: 8px 16px !important;
                display: flex !important;
                align-items: center !important;
                justify-content: space-between !important;
                border-top: 1px solid #1f2937 !important;
                font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace !important;
                font-size: 11.5px !important;
                color: #94a3b8 !important;
            }
            .cl-schema-footer .status {
                display: flex !important;
                align-items: center !important;
                gap: 6px !important;
                color: #10b981 !important;
                font-weight: 600 !important;
            }
            .cl-schema-footer .pulse-dot {
                width: 6px !important;
                height: 6px !important;
                border-radius: 50% !important;
                background: #10b981 !important;
                box-shadow: 0 0 6px #10b981 !important;
                display: inline-block !important;
            }
            .cl-schema-footer .info-tags {
                display: flex !important;
                align-items: center !important;
                gap: 12px !important;
                color: #64748b !important;
            }
        </style>

        <!-- MAC-STYLE WINDOW TITLEBAR & QUICK ACTIONS -->
        <div class="cl-schema-header">
            <!-- Left: Window Dots + File Tag -->
            <div style="display: flex; align-items: center; gap: 12px;">
                <div class="cl-mac-dots">
                    <span class="cl-mac-dot red"></span>
                    <span class="cl-mac-dot yellow"></span>
                    <span class="cl-mac-dot green"></span>
                </div>
                <div class="cl-schema-tab">
                    <span class="bracket">{ }</span>
                    <span class="filename">schema.jsonld</span>
                    <span class="badge">Schema.org Graph</span>
                </div>
            </div>

            <!-- Right: Nạp mẫu & Tiện ích Toolbar -->
            <div class="cl-schema-tools">
                <span class="cl-schema-label">Nạp mẫu:</span>
                <button type="button" @click="loadTemplate('service')" class="cl-schema-btn btn-sky" title="Nạp mẫu Service chuyên nghiệp">
                    ⚡ Service
                </button>
                <button type="button" @click="loadTemplate('webpage')" class="cl-schema-btn btn-slate" title="Nạp mẫu WebPage">
                    📄 WebPage
                </button>
                <button type="button" @click="loadTemplate('faq')" class="cl-schema-btn btn-emerald" title="Nạp mẫu FAQPage câu hỏi thường gặp">
                    ❓ FAQ
                </button>

                <div class="cl-schema-divider"></div>

                <button type="button" @click="formatJson()" class="cl-schema-btn btn-amber" title="Làm đẹp, thụt dòng chuẩn JSON">
                    ✨ Định dạng
                </button>
                <button type="button" @click="copyCode()" class="cl-schema-btn btn-slate" title="Sao chép toàn bộ mã">
                    <span x-text="copied ? '✓ Đã chép' : '📋 Chép'"></span>
                </button>
                <button type="button" @click="clearCode()" class="cl-schema-btn btn-rose" title="Xóa trắng mã Schema">
                    🗑️ Xóa
                </button>
            </div>
        </div>

        <!-- CODE EDITOR TEXTAREA -->
        <div class="cl-schema-body">
            <textarea 
                x-model="code"
                @keydown="handleKeyDown($event)"
                rows="18"
                placeholder="{\n  &quot;@type&quot;: &quot;Service&quot;,\n  &quot;name&quot;: &quot;Tên dịch vụ...&quot;\n}"
                spellcheck="false"
                class="cl-schema-textarea"
            ></textarea>
        </div>

        <!-- STATUS BAR FOOTER -->
        <div class="cl-schema-footer">
            <div style="display: flex; align-items: center; gap: 12px;">
                <span class="status">
                    <span class="pulse-dot"></span>
                    Google Rich Results Ready
                </span>
                <span style="color: #475569;">•</span>
                <span style="color: #64748b;">Phím Tab thụt dòng 2 spaces</span>
            </div>
            <div class="info-tags">
                <span>UTF-8</span>
                <span>JSON-LD</span>
            </div>
        </div>
    </div>
</x-dynamic-component>
