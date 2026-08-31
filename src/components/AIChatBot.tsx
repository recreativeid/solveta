"use client";

import React, { useState, useRef, useEffect } from "react";
import { motion, AnimatePresence } from "framer-motion";
import { MessageSquare, Send, X, Bot, Sparkles, User, Phone } from "lucide-react";
import { useSiteData } from "@/context/SiteDataContext";

interface ChatMessage {
  id: string;
  sender: "bot" | "user";
  text: string;
  timestamp: string;
  escalateToCS?: boolean;
}

const quickSuggestions = [
  "Berapa harga paket website?",
  "Apa beda Basic & Standard?",
  "Bisa buat sistem kasir / database?",
  "Berapa lama pengerjaan?",
];

export const AIChatBot: React.FC = () => {
  const { data } = useSiteData();
  const [isOpen, setIsOpen] = useState(false);
  const [input, setInput] = useState("");
  const [loading, setLoading] = useState(false);
  const [messages, setMessages] = useState<ChatMessage[]>([
    {
      id: "welcome",
      sender: "bot",
      text: "Halo! 👋 Saya SOLVETA AI Assistant. Ada yang bisa saya bantu terkait solusi digital, website, sistem database, atau paket harga bisnis Anda?",
      timestamp: "Baru saja",
    },
  ]);

  const messagesEndRef = useRef<HTMLDivElement>(null);

  useEffect(() => {
    messagesEndRef.current?.scrollIntoView({ behavior: "smooth" });
  }, [messages, loading]);

  const sendMessage = async (textToSend?: string) => {
    const text = (textToSend || input).trim();
    if (!text || loading) return;

    const userMsg: ChatMessage = {
      id: "user-" + Date.now(),
      sender: "user",
      text,
      timestamp: new Date().toLocaleTimeString([], { hour: "2-digit", minute: "2-digit" }),
    };

    setMessages((prev) => [...prev, userMsg]);
    if (!textToSend) setInput("");
    setLoading(true);

    try {
      const res = await fetch("/api/chat", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
          message: text,
          apiKey: data.geminiApiKey,
          customContact: data.contact,
        }),
      });

      if (res.ok) {
        const json = await res.json();
        const botMsg: ChatMessage = {
          id: "bot-" + Date.now(),
          sender: "bot",
          text: json.reply,
          timestamp: new Date().toLocaleTimeString([], { hour: "2-digit", minute: "2-digit" }),
          escalateToCS: json.escalateToCS,
        };
        setMessages((prev) => [...prev, botMsg]);
      } else {
        throw new Error("Failed response");
      }
    } catch (err) {
      setMessages((prev) => [
        ...prev,
        {
          id: "bot-error-" + Date.now(),
          sender: "bot",
          text: "Untuk pertanyaan lebih detail atau konsultasi langsung, silakan hubungi tim Admin CS kami via WhatsApp.",
          timestamp: new Date().toLocaleTimeString([], { hour: "2-digit", minute: "2-digit" }),
          escalateToCS: true,
        },
      ]);
    } finally {
      setLoading(false);
    }
  };

  return (
    <div className="fixed bottom-5 right-5 z-50">
      {/* Floating Trigger Button */}
      {!isOpen && (
        <motion.button
          initial={{ scale: 0, opacity: 0 }}
          animate={{ scale: 1, opacity: 1 }}
          whileHover={{ scale: 1.08 }}
          whileTap={{ scale: 0.95 }}
          onClick={() => setIsOpen(true)}
          className="flex items-center gap-2.5 bg-brand-800 hover:bg-brand-900 text-white font-semibold text-xs px-4 py-3 rounded-full shadow-lg hover:shadow-xl transition-all duration-300 border border-brand-700"
        >
          <div className="relative">
            <Bot className="w-5 h-5" />
            <span className="absolute -top-1 -right-1 w-2 h-2 rounded-full bg-emerald-400 animate-pulse" />
          </div>
          <span>Tanya SOLVETA AI</span>
          <Sparkles className="w-3.5 h-3.5 text-amber-300" />
        </motion.button>
      )}

      {/* Chat Window Dialog */}
      <AnimatePresence>
        {isOpen && (
          <motion.div
            initial={{ opacity: 0, scale: 0.9, y: 20 }}
            animate={{ opacity: 1, scale: 1, y: 0 }}
            exit={{ opacity: 0, scale: 0.9, y: 20 }}
            transition={{ duration: 0.25, ease: [0.16, 1, 0.3, 1] }}
            className="w-[360px] sm:w-[400px] h-[520px] bg-white border border-gray-200 rounded-2xl shadow-2xl flex flex-col overflow-hidden"
          >
            {/* Chat Header */}
            <div className="bg-brand-800 text-white p-3.5 px-4 flex items-center justify-between">
              <div className="flex items-center gap-2.5">
                <div className="w-8 h-8 rounded-lg bg-white/10 flex items-center justify-center">
                  <Bot className="w-5 h-5 text-white" />
                </div>
                <div>
                  <div className="text-xs font-bold flex items-center gap-1.5">
                    <span>SOLVETA AI Assistant</span>
                    <span className="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-ping" />
                  </div>
                  <div className="text-[10px] text-white/70">
                    Online &bull; Powered by Gemini
                  </div>
                </div>
              </div>

              <button
                onClick={() => setIsOpen(false)}
                className="text-white/80 hover:text-white p-1 rounded-md hover:bg-white/10 transition-colors"
              >
                <X className="w-4 h-4" />
              </button>
            </div>

            {/* Messages Area */}
            <div className="flex-grow p-4 overflow-y-auto space-y-3.5 bg-gray-50/50">
              {messages.map((msg) => (
                <div
                  key={msg.id}
                  className={`flex gap-2.5 ${
                    msg.sender === "user" ? "justify-end" : "justify-start"
                  }`}
                >
                  {msg.sender === "bot" && (
                    <div className="w-6 h-6 rounded-md bg-brand-50 border border-brand-100 text-brand-800 flex items-center justify-center flex-shrink-0 mt-0.5">
                      <Bot className="w-3.5 h-3.5" />
                    </div>
                  )}

                  <div
                    className={`max-w-[82%] rounded-2xl px-3.5 py-2.5 text-xs leading-relaxed ${
                      msg.sender === "user"
                        ? "bg-brand-800 text-white rounded-br-xs"
                        : "bg-white border border-gray-200 text-gray-800 shadow-2xs rounded-bl-xs"
                    }`}
                  >
                    <div className="whitespace-pre-line">{msg.text}</div>

                    {msg.escalateToCS && (
                      <div className="mt-3 pt-2.5 border-t border-gray-100">
                        <a
                          href={`https://wa.me/${data.contact.whatsappNumber}?text=${encodeURIComponent(
                            "Halo Admin CS SOLVETA, saya ingin berkonsultasi langsung mengenai kebutuhan digital bisnis saya."
                          )}`}
                          target="_blank"
                          rel="noopener noreferrer"
                          className="inline-flex items-center gap-1.5 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-[11px] px-3 py-1.5 rounded-lg transition-colors shadow-xs"
                        >
                          <Phone className="w-3 h-3" />
                          <span>Hubungi CS via WhatsApp</span>
                        </a>
                      </div>
                    )}

                    <div
                      className={`text-[9px] mt-1 text-right ${
                        msg.sender === "user" ? "text-white/60" : "text-gray-400"
                      }`}
                    >
                      {msg.timestamp}
                    </div>
                  </div>
                </div>
              ))}

              {loading && (
                <div className="flex gap-2 items-center text-xs text-gray-400">
                  <div className="w-6 h-6 rounded-md bg-brand-50 text-brand-800 flex items-center justify-center flex-shrink-0">
                    <Bot className="w-3.5 h-3.5 animate-spin" />
                  </div>
                  <div className="bg-white border border-gray-200 rounded-2xl px-3 py-2 text-gray-500 text-xs shadow-2xs flex items-center gap-1">
                    <span className="w-1.5 h-1.5 rounded-full bg-gray-400 animate-bounce" />
                    <span className="w-1.5 h-1.5 rounded-full bg-gray-400 animate-bounce delay-100" />
                    <span className="w-1.5 h-1.5 rounded-full bg-gray-400 animate-bounce delay-200" />
                  </div>
                </div>
              )}

              <div ref={messagesEndRef} />
            </div>

            {/* Quick Suggestions */}
            {messages.length <= 2 && (
              <div className="p-2 px-3 bg-white border-t border-gray-100 flex flex-wrap gap-1">
                {quickSuggestions.map((s) => (
                  <button
                    key={s}
                    onClick={() => sendMessage(s)}
                    className="text-[10px] font-medium text-gray-600 bg-gray-100 hover:bg-brand-50 hover:text-brand-800 px-2.5 py-1 rounded-full transition-colors"
                  >
                    {s}
                  </button>
                ))}
              </div>
            )}

            {/* Input Footer */}
            <form
              onSubmit={(e) => {
                e.preventDefault();
                sendMessage();
              }}
              className="p-2.5 bg-white border-t border-gray-200 flex items-center gap-2"
            >
              <input
                type="text"
                value={input}
                onChange={(e) => setInput(e.target.value)}
                placeholder="Tulis pertanyaan Anda..."
                className="flex-grow text-xs text-gray-800 placeholder-gray-400 outline-none px-3 py-2 bg-gray-50 rounded-lg border border-gray-200 focus:border-brand-600 focus:bg-white transition-all"
              />
              <button
                type="submit"
                disabled={!input.trim() || loading}
                className="p-2 rounded-lg bg-brand-800 hover:bg-brand-900 disabled:opacity-40 text-white transition-colors"
              >
                <Send className="w-3.5 h-3.5" />
              </button>
            </form>
          </motion.div>
        )}
      </AnimatePresence>
    </div>
  );
};
