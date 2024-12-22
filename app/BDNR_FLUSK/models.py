from datetime import datetime

class Upaya:
    @staticmethod
    def serialize(Upaya_peningkatan):
        return {
            # "id": Upaya_peningkatan.get("id"),
            "nama_upaya": Upaya_peningkatan.get("nama_upaya"),
        }
