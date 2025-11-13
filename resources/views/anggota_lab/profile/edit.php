    <?php 
$pageTitle = 'Edit Profil Lab User';
$activeMenu = 'profile-user-lab';
?>
<?php require BASE_PATH . '/resources/views/layouts/dashboard.php'; ?>
    <!-- Card -->
    <form action="#" method="post" class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
      <!-- Basic Info -->
      <section class="p-6 border-b border-slate-200">
        <h2 class="text-lg font-semibold mb-4">Informasi Dasar</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
          <div>
            <label class="block text-sm font-medium mb-1">Nama Lengkap</label>
            <input type="text" class="w-full rounded-md border border-gray-300 focus:ring-sky-500 focus:border-sky-500" placeholder="Mamluatul Hani'ah, S.Kom., M.Kom" value="Mamluatul Hani'ah, S.Kom., M.Kom" />
          </div>
          <div>
            <label class="block text-sm font-medium mb-1">Email Kontak</label>
            <input name="contact_email" type="email" class="w-full rounded-md border border-gray-300 focus:ring-sky-500 focus:border-sky-500" placeholder="nama@kampus.ac.id" value="hani@example.com"/>
          </div>
          <div>
            <label class="block text-sm font-medium mb-1">NIP</label>
            <input name="nip" type="text" class="w-full rounded-md border border-gray-300 focus:ring-sky-500 focus:border-sky-500" placeholder="1990..." value="199002062019032013"/>
          </div>
          <div>
            <label class="block text-sm font-medium mb-1">NIDN</label>
            <input name="nidn" type="text" class="w-full rounded-md border border-gray-300 focus:ring-sky-500 focus:border-sky-500" placeholder="000..." value="0006029003"/>
          </div>
          <div>
            <label class="block text-sm font-medium mb-1">Program Studi / Major</label>
            <select name="major" class="w-full rounded-md border border-gray-300 focus:ring-sky-500 focus:border-sky-500">
              <option>Teknik Informatika</option>
              <option>Sistem Informasi Bisnis</option>
              <option>Pengembangan Piranti Lunak Situs</option>
              <option>Rekayasa Teknologi Informasi</option>
            </select>
          </div>
          <div>
            <label class="block text-sm font-medium mb-1">Photo URL</label>
            <input name="photo_url" type="url" class="w-full rounded-md border border-gray-300 focus:ring-sky-500 focus:border-sky-500" placeholder="https://..." value="https://via.placeholder.com/220x300.png?text=Photo"/>
          </div>
        </div>
      </section>

      <!-- Social Links -->
      <section class="p-6 border-b border-slate-200">
        <h2 class="text-lg font-semibold mb-4">Social Links</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
          <div>
            <label class="text-xs text-slate-600">LinkedIn</label>
            <input name="social_links[linkedin]" type="url" class="mt-1 w-full rounded-md border border-gray-300 focus:ring-sky-500 focus:border-sky-500" placeholder="https://linkedin.com/in/..." value="https://linkedin.com/in/dummy"/>
          </div>
          <div>
            <label class="text-xs text-slate-600">Google Scholar</label>
            <input name="social_links[google_scholar]" type="url" class="mt-1 w-full rounded-md border border-gray-300 focus:ring-sky-500 focus:border-sky-500" placeholder="https://scholar.google.com/..." value="https://scholar.google.com/citations?user=dummy"/>
          </div>
          <div>
            <label class="text-xs text-slate-600">Sinta</label>
            <input name="social_links[sinta]" type="url" class="mt-1 w-full rounded-md border border-gray-300 focus:ring-sky-500 focus:border-sky-500" placeholder="https://sinta.kemdikbud.go.id/..." value="https://sinta.kemdikbud.go.id/authors/detail?id=dummy"/>
          </div>
          <div>
            <label class="text-xs text-slate-600">CV URL</label>
            <input name="social_links[cv]" type="url" class="mt-1 w-full rounded-md border border-gray-300 focus:ring-sky-500 focus:border-sky-500" placeholder="https://drive.google.com/..." value="#"/>
          </div>
          <div>
            <label class="text-xs text-slate-600">Website</label>
            <input name="social_links[website]" type="url" class="mt-1 w-full rounded-md border border-gray-300 focus:ring-sky-500 focus:border-sky-500" placeholder="https://..." value=""/>
          </div>
          <div>
            <label class="text-xs text-slate-600">Email Publik</label>
            <input name="social_links[email]" type="email" class="mt-1 w-full rounded-md border border-gray-300 focus:ring-sky-500 focus:border-sky-500" placeholder="contact@domain" value="hani@example.com"/>
          </div>
        </div>
      </section>

      <!-- Research Focus -->
      <section class="p-6 border-b border-slate-200" x-data>
        <h2 class="text-lg font-semibold mb-4">Research Focus</h2>
        <div class="flex flex-wrap gap-2 mb-3">
          <template x-for="(tag, i) in researchFocus" :key="i">
            <span class="px-3 py-1 rounded-full bg-sky-50 text-sky-700 text-xs inline-flex items-center gap-2">
              <input type="hidden" name="research_focus[]" :value="tag">
              <span x-text="tag"></span>
              <button type="button" class="text-sky-700 hover:text-sky-900" @click="researchFocus.splice(i,1)">
                <i class="fa-solid fa-xmark"></i>
              </button>
            </span>
          </template>
        </div>
        <div class="flex gap-2">
          <input x-model="newTag" type="text" class="flex-1 rounded-md border border-gray-300 focus:ring-sky-500 focus:border-sky-500" placeholder="Tambah fokus riset (Enter)"/>
          <button type="button" class="px-3 py-2 bg-sky-600 text-white rounded-md hover:bg-sky-700" @click="addTag()">Tambah</button>
        </div>
        <p class="text-xs text-slate-500 mt-2">Contoh: Data Science, Machine Learning, Information Retrieval, AI.</p>
      </section>

      <!-- Educations -->
      <section class="p-6 border-b border-slate-200">
        <div class="flex items-center justify-between mb-4">
          <h2 class="text-lg font-semibold">Pendidikan</h2>
          <button type="button" class="text-sm text-sky-600 hover:text-sky-800" @click="addEducation()"><i class="fa fa-plus mr-1"></i>Tambah</button>
        </div>
        <div class="space-y-4">
          <template x-for="(edu, i) in educations" :key="i">
            <div class="grid grid-cols-1 md:grid-cols-5 gap-3 bg-slate-50 p-3 rounded-lg border border-slate-200">
              <div>
                <label class="text-xs text-slate-600">Level</label>
                <select :name="`educations[${i}][level]`" x-model="edu.level" class="w-full rounded-md border border-gray-300 focus:ring-sky-500 focus:border-sky-500">
                  <option>S1</option><option>S2</option><option>S3</option><option>D3</option><option>D4</option><option>Profesi</option>
                </select>
              </div>
              <div class="md:col-span-2">
                <label class="text-xs text-slate-600">Degree</label>
                <input :name="`educations[${i}][degree]`" x-model="edu.degree" type="text" class="w-full rounded-md border border-gray-300 focus:ring-sky-500 focus:border-sky-500" placeholder="Teknik Informatika"/>
              </div>
              <div>
                <label class="text-xs text-slate-600">Mulai</label>
                <input :name="`educations[${i}][start_year]`" x-model="edu.start_year" type="number" class="w-full rounded-md border border-gray-300 focus:ring-sky-500 focus:border-sky-500" placeholder="2014"/>
              </div>
              <div>
                <label class="text-xs text-slate-600">Selesai</label>
                <input :name="`educations[${i}][end_year]`" x-model="edu.end_year" type="number" class="w-full rounded-md border border-gray-300 focus:ring-sky-500 focus:border-sky-500" placeholder="2016"/>
              </div>
              <div class="md:col-span-5">
                <label class="text-xs text-slate-600">Institusi</label>
                <input :name="`educations[${i}][institution]`" x-model="edu.institution" type="text" class="w-full rounded-md border border-gray-300 focus:ring-sky-500 focus:border-sky-500" placeholder="Institut Teknologi Sepuluh Nopember"/>
              </div>
              <div class="md:col-span-5 flex justify-end">
                <button type="button" class="text-xs text-rose-600 hover:text-rose-800" @click="educations.splice(i,1)"><i class="fa fa-trash mr-1"></i>Hapus</button>
              </div>
            </div>
          </template>
        </div>
      </section>

      <!-- Certifications -->
      <section class="p-6 border-b border-slate-200">
        <div class="flex items-center justify-between mb-4">
          <h2 class="text-lg font-semibold">Sertifikasi</h2>
          <button type="button" class="text-sm text-sky-600 hover:text-sky-800" @click="addCert()"><i class="fa fa-plus mr-1"></i>Tambah</button>
        </div>
        <div class="space-y-4">
          <template x-for="(c, i) in certifications" :key="i">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-3 bg-slate-50 p-3 rounded-lg border border-slate-200">
              <div class="md:col-span-2">
                <label class="text-xs text-slate-600">Nama Sertifikasi</label>
                <input :name="`certifications[${i}][name]`" x-model="c.name" type="text" class="w-full rounded-md border border-gray-300 focus:ring-sky-500 focus:border-sky-500" placeholder="Azure AI Fundamentals"/>
              </div>
              <div>
                <label class="text-xs text-slate-600">Issuer</label>
                <input :name="`certifications[${i}][issuer]`" x-model="c.issuer" type="text" class="w-full rounded-md border border-gray-300 focus:ring-sky-500 focus:border-sky-500" placeholder="Microsoft"/>
              </div>
              <div>
                <label class="text-xs text-slate-600">Tanggal Terbit</label>
                <input :name="`certifications[${i}][issued_on]`" x-model="c.issued_on" type="date" class="w-full rounded-md border border-gray-300 focus:ring-sky-500 focus:border-sky-500"/>
              </div>
              <div class="md:col-span-4">
                <label class="text-xs text-slate-600">Credential URL</label>
                <input :name="`certifications[${i}][credential_url]`" x-model="c.credential_url" type="url" class="w-full rounded-md border border-gray-300 focus:ring-sky-500 focus:border-sky-500" placeholder="https://..."/>
              </div>
              <div class="md:col-span-4 flex justify-end">
                <button type="button" class="text-xs text-rose-600 hover:text-rose-800" @click="certifications.splice(i,1)"><i class="fa fa-trash mr-1"></i>Hapus</button>
              </div>
            </div>
          </template>
        </div>
      </section>

      <!-- Actions -->
      <div class="p-6 flex items-center justify-end gap-3 bg-slate-50">
        <button type="button" class="px-5 py-2 rounded-md border border-slate-300 hover:bg-white">Batal</button>
        <button type="submit" class="px-6 py-2 rounded-md bg-sky-600 text-white hover:bg-sky-700 shadow">Simpan Perubahan</button>
      </div>
    </form>
  </div>

  <script>
    function profileEditor() {
      return {
        // Dummy data (tanpa PHP)
        researchFocus: ["Data Science","Machine Learning","Information Retrieval","Artificial Intelligence"],
        newTag: "",
        educations: [
          { level: "S2", degree: "Teknik Informatika", institution: "Institut Teknologi Sepuluh Nopember", start_year: 2014, end_year: 2016 },
          { level: "S1", degree: "Ilmu Komputer", institution: "Universitas Brawijaya", start_year: 2009, end_year: 2014 }
        ],
        certifications: [
          { name: "IT Specialist - Artificial Intelligence", issuer: "Pearson VUE", issued_on: "2025-02-01", credential_url: "" },
          { name: "Microsoft certified Azure AI Fundamentals", issuer: "Microsoft", issued_on: "2022-10-01", credential_url: "" }
        ],

        addTag() {
          const t = this.newTag.trim();
          if (!t) return;
          if (!this.researchFocus.includes(t)) this.researchFocus.push(t);
          this.newTag = "";
        },

        addEducation() {
          this.educations.push({ level: "S1", degree: "", institution: "", start_year: "", end_year: "" });
        },

        addCert() {
          this.certifications.push({ name: "", issuer: "", issued_on: "", credential_url: "" });
        }
      }
    }
  </script>
</body>
</html>
