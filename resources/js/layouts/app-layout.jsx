// resources/js/layouts/app-layout.jsx

import { AppSidebar } from "@/components/app-sidebar";
import { Button } from "@/components/ui/button";
import {
    Select,
    SelectContent,
    SelectGroup,
    SelectItem,
    SelectLabel,
    SelectTrigger,
    SelectValue,
} from "@/components/ui/select";
import { Separator } from "@/components/ui/separator";
import {
    SidebarInset,
    SidebarProvider,
    SidebarTrigger,
} from "@/components/ui/sidebar";
import { useTheme } from "@/providers/theme-provider";

import { usePage } from "@inertiajs/react";

import * as Icon from "@tabler/icons-react";
import { Moon, Sun } from "lucide-react";
import { Toaster } from "sonner";
import { route } from "ziggy-js";

export default function AppLayout({ children }) {
    const { auth, appName, pageName } = usePage().props;
    const { theme, colorTheme, toggleTheme, setColorTheme } = useTheme();

    const colorThemes = [
        "blue",
        "green",
        "default",
        "orange",
        "red",
        "rose",
        "violet",
        "yellow",
    ];

    const navData = [
        {
            title: "Main",
            items: [
                {
                    title: "Beranda",
                    url: route("home"),
                    icon: Icon.IconHome,
                },
                {
                    title: "Todo",
                    url: route("todo"),
                    icon: Icon.IconChecklist,
                },
            ],
        },
        {
            title: "Penghargaan",
            items: [
                {
                    title: "Statistik",
                    url: route("penghargaan.statistik"),
                    icon: Icon.IconChartBar,
                },
                {
                    title: "Daftar Pengajuan",
                    url: route("penghargaan.daftar"),
                    icon: Icon.IconListDetails,
                },
            ],
        },

        // ⭐ SIDEBAR PENGAJUAN JURNAL
        {
            title: "Pengajuan Jurnal",
            items: [
                {
                    title: "Daftar Jurnal",
                    url: route("pengajuan.jurnal.daftar"),
                    icon: Icon.IconBook,
                },
            ],
        },

        {
            title: "Admin",
            items: [
                {
                    title: "Hak Akses",
                    url: route("hak-akses"),
                    icon: Icon.IconLock,
                },
            ],
        },
    ];

    return (
        <>
            <SidebarProvider
                style={{
                    "--sidebar-width": "calc(var(--spacing) * 72)",
                    "--header-height": "calc(var(--spacing) * 12)",
                }}
            >
                <AppSidebar
                    active={pageName}
                    user={auth}
                    navData={navData}
                    appName={appName}
                    variant="inset"
                />

                <SidebarInset>
                    <header className="flex h-(--header-height) shrink-0 items-center gap-2 border-b bg-background/95 backdrop-blur-sm sticky top-0 z-50">
                        <div className="flex w-full items-center gap-1 px-4 lg:px-6">
                            <SidebarTrigger className="-ml-1" />
                            <Separator orientation="vertical" className="mx-2 h-4" />

                            <h1 className="text-base font-medium">{pageName}</h1>

                            <div className="ml-auto flex items-center gap-2">
                                <Select
                                    className="capitalize"
                                    value={colorTheme}
                                    onValueChange={setColorTheme}
                                >
                                    <SelectTrigger>
                                        <SelectValue placeholder="Pilih Tema" />
                                    </SelectTrigger>
                                    <SelectContent>
                                        <SelectGroup>
                                            <SelectLabel>Tema</SelectLabel>
                                            {colorThemes.map((item) => (
                                                <SelectItem key={item} value={item}>
                                                    {item}
                                                </SelectItem>
                                            ))}
                                        </SelectGroup>
                                    </SelectContent>
                                </Select>

                                <Button variant="ghost" size="icon" onClick={toggleTheme}>
                                    {theme === "light" ? (
                                        <Sun className="h-4 w-4" />
                                    ) : (
                                        <Moon className="h-4 w-4" />
                                    )}
                                </Button>
                            </div>
                        </div>
                    </header>

                    <div className="flex flex-1 flex-col">
                        <div className="@container/main flex flex-1 flex-col gap-2">
                            <div className="flex flex-col gap-4 py-4 px-4 md:px-6 md:py-6">
                                {children}
                            </div>
                        </div>
                    </div>
                </SidebarInset>
            </SidebarProvider>

            <Toaster richColors position="top-center" />
        </>
    );
}
