import AppLayout from "@/layouts/app-layout";
import { router } from "@inertiajs/react";
import { useState } from "react";

import { Input } from "@/components/ui/input";
import { Button } from "@/components/ui/button";
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from "@/components/ui/select";

export default function PilihDataPenghargaanPage() {
    const [sintaId, setSintaId] = useState("");
    const [scopusId, setScopusId] = useState("");
    const [prosiding, setProsiding] = useState("");

    const handleLanjutkan = () => {
        // Navigasi ke FormPenghargaanJurnalPage dengan membawa data
        router.visit(route("pengajuan.jurnal.form"), {
            method: "get",
            data: {
                sinta_id: sintaId,
                scopus_id: scopusId,
                prosiding: prosiding,
            },
        });
    };

    return (
        <AppLayout>
            <div className="flex flex-col gap-8">
                <Button
                    variant="outline"
                    onClick={() => router.visit(route("pengajuan.jurnal.daftar"))}
                    className="w-fit"
                >
                    ← Kembali
                </Button>

                <h2 className="text-xl font-semibold text-center">
                    Pengajuan Penghargaan Jurnal oleh Dosen
                </h2>

                <div className="grid md:grid-cols-2 gap-6">
                    <div className="flex flex-col gap-2">
                        <label className="text-sm font-medium">Sinta ID</label>
                        <Input
                            placeholder="Value"
                            value={sintaId}
                            onChange={(e) => setSintaId(e.target.value)}
                        />
                    </div>

                    <div className="flex flex-col gap-2">
                        <label className="text-sm font-medium">Scopus ID</label>
                        <Input
                            placeholder="Value"
                            value={scopusId}
                            onChange={(e) => setScopusId(e.target.value)}
                        />
                    </div>
                </div>

                <div className="flex flex-col gap-2">
                    <label className="text-sm font-medium">Prosiding</label>
                    <Select value={prosiding} onValueChange={setProsiding}>
                        <SelectTrigger>
                            <SelectValue placeholder="Value" />
                        </SelectTrigger>
                        <SelectContent>
                            <SelectItem value="q1">Prosiding Q1</SelectItem>
                            <SelectItem value="q2">Prosiding Q2</SelectItem>
                            <SelectItem value="q3">Prosiding Q3</SelectItem>
                            <SelectItem value="q4">Prosiding Q4</SelectItem>
                        </SelectContent>
                    </Select>
                </div>

                <Button
                    onClick={handleLanjutkan}
                    className="mt-4 w-fit ml-auto px-6"
                >
                    Lanjutkan
                </Button>
            </div>
        </AppLayout>
    );
}