import AppLayout from "@/layouts/app-layout";
import { router, usePage } from "@inertiajs/react";
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

export default function FormPenghargaanJurnalPage() {
    // Ambil data dari props (dari halaman sebelumnya)
    const props = usePage().props;
    
    const [formData, setFormData] = useState({
        sintaId: props.sinta_id || "",
        scopusId: props.scopus_id || "",
        prosiding: props.prosiding || "",
        judulMakalah: "",
        issn: "",
        volume: "",
        penulis: "",
        nomor: "",
        halPaper: "",
        tempatPelaksanaan: "",
        url: "",
    });

    const handleChange = (field, value) => {
        setFormData((prev) => ({
            ...prev,
            [field]: value,
        }));
    };

    const handleSubmit = () => {
        // Validasi
        if (!formData.judulMakalah) {
            alert("Judul Makalah wajib diisi!");
            return;
        }
        if (!formData.issn) {
            alert("ISSN wajib diisi!");
            return;
        }

        console.log("Data yang akan dikirim:", formData);

        // Submit ke backend
        router.post(route("pengajuan.jurnal.store"), formData, {
            onSuccess: () => {
                alert("Data berhasil disimpan!");
                router.visit(route("pengajuan.jurnal.daftar"));
            },
            onError: (errors) => {
                console.error("Error:", errors);
                alert("Terjadi kesalahan saat menyimpan data");
            },
        });
    };

    return (
        <AppLayout>
            <Button
                variant="outline"
                onClick={() => router.visit(route("pengajuan.jurnal.pilih-data"))}
                className="mb-6"
            >
                ← Kembali
            </Button>

            <h2 className="text-xl font-semibold text-center mb-6">
                Pengajuan Penghargaan Jurnal oleh Dosen
            </h2>

            <div className="border-2 border-blue-500 rounded-xl p-8 max-w-4xl mx-auto flex flex-col gap-6">
                {/* Row 1 - Sinta ID & Scopus ID */}
                <div className="grid md:grid-cols-2 gap-6">
                    <div>
                        <label className="text-sm font-medium">Sinta ID</label>
                        <Input
                            placeholder="Value"
                            value={formData.sintaId}
                            onChange={(e) =>
                                handleChange("sintaId", e.target.value)
                            }
                        />
                    </div>
                    <div>
                        <label className="text-sm font-medium">Scopus ID</label>
                        <Input
                            placeholder="Value"
                            value={formData.scopusId}
                            onChange={(e) =>
                                handleChange("scopusId", e.target.value)
                            }
                        />
                    </div>
                </div>

                {/* Judul Makalah */}
                <div>
                    <label className="text-sm font-medium">
                        Judul Makalah <span className="text-red-500">*</span>
                    </label>
                    <Input
                        placeholder="Value"
                        value={formData.judulMakalah}
                        onChange={(e) =>
                            handleChange("judulMakalah", e.target.value)
                        }
                    />
                </div>

                {/* Row 2 - ISSN, Volume, Penulis */}
                <div className="grid md:grid-cols-3 gap-6">
                    <div>
                        <label className="text-sm font-medium">
                            ISSN <span className="text-red-500">*</span>
                        </label>
                        <Input
                            placeholder="Value"
                            value={formData.issn}
                            onChange={(e) =>
                                handleChange("issn", e.target.value)
                            }
                        />
                    </div>
                    <div>
                        <label className="text-sm font-medium">Volume</label>
                        <Input
                            placeholder="Value"
                            value={formData.volume}
                            onChange={(e) =>
                                handleChange("volume", e.target.value)
                            }
                        />
                    </div>
                    <div>
                        <label className="text-sm font-medium">Penulis</label>
                        <Select
                            value={formData.penulis}
                            onValueChange={(value) =>
                                handleChange("penulis", value)
                            }
                        >
                            <SelectTrigger>
                                <SelectValue placeholder="Value" />
                            </SelectTrigger>
                            <SelectContent>
                                <SelectItem value="penulis1">
                                    Penulis 1
                                </SelectItem>
                                <SelectItem value="penulis2">
                                    Penulis 2
                                </SelectItem>
                                <SelectItem value="penulis3">
                                    Penulis 3
                                </SelectItem>
                            </SelectContent>
                        </Select>
                    </div>
                </div>

                {/* Nomor */}
                <div>
                    <label className="text-sm font-medium">Nomor</label>
                    <Input
                        placeholder="Value"
                        value={formData.nomor}
                        onChange={(e) => handleChange("nomor", e.target.value)}
                    />
                </div>

                {/* Row 3 - Hal Paper & Tempat Pelaksanaan */}
                <div className="grid md:grid-cols-2 gap-6">
                    <div>
                        <label className="text-sm font-medium">
                            Hal Paper di Jurnal
                        </label>
                        <Input
                            placeholder="Value"
                            value={formData.halPaper}
                            onChange={(e) =>
                                handleChange("halPaper", e.target.value)
                            }
                        />
                    </div>
                    <div>
                        <label className="text-sm font-medium">
                            Tempat Pelaksanaan
                        </label>
                        <Input
                            placeholder="Value"
                            value={formData.tempatPelaksanaan}
                            onChange={(e) =>
                                handleChange("tempatPelaksanaan", e.target.value)
                            }
                        />
                    </div>
                </div>

                {/* URL */}
                <div>
                    <label className="text-sm font-medium">URL</label>
                    <Input
                        placeholder="Value"
                        value={formData.url}
                        onChange={(e) => handleChange("url", e.target.value)}
                    />
                </div>

                {/* Button Submit */}
                <Button
                    onClick={handleSubmit}
                    className="mt-4 w-fit ml-auto px-6"
                >
                    Simpan Data & Lanjutkan
                </Button>
            </div>
        </AppLayout>
    );
}