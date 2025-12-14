<script setup>
    import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
    import TextInput from "@/Components/TextInput.vue";
    import InputLabel from "@/Components/InputLabel.vue";
    import { useForm } from "@inertiajs/vue3";
    import { ref } from "vue";
    import axios from 'axios'; 

    const prompt = ref('');
    const form = useForm({
        prompt: '',
    });

    const imageUrl = ref(''); 
    const loading = ref(false);
    const savedImages = [];

    const generateImage = async () => {
        loading.value = true;
        imageUrl.value = '';

        try {
            const response = await axios.get(route('imageGeneration', {
                prompt: form.prompt
            }));
            if (response.data.success) {
                imageUrl.value = response.data.imageUrl;
                savedImages.unshift(response.data.imageUrl);
                console.log('Image URL received:', response.data.imageUrl);
                console.log(savedImages);
            }
        } catch (error) {
            console.error('Error generating image:', error);
        } finally {
            loading.value = false;
        }
    };
</script>

<template>
    <AuthenticatedLayout>
        <div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
            <form @submit.prevent="generateImage">
                <InputLabel for="image_prompt" value="Write your idea for a comic cover here:" class="text-xl" />
                <TextInput
                    type="text"
                    id="image_prompt"
                    required
                    v-model="form.prompt"
                    class="w-full max-h-26 h-16 bg-neutral-900 rounded-2xl shadow-md shadow-blue-900 text-white mt-4 p-4 text-lg break-words"
                    placeholder="Enter a description for your comic cover (e.g., 'A heroic figure standing atop a city skyline at sunset')"
                />
                <button type="submit" :disabled="loading" class="mt-4 px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-150">
                    <span v-if="loading">Generating...</span>
                    <span v-else>Generate Cover</span>
                </button>
            </form>
        </div>

        <div class="max-w-7xl w-full mx-auto py-6 bg-neutral-900 rounded-xl flex flex-wrap gap-5 justify-start items-center min-h-[300px] ">
            <div v-if="loading" class="text-white text-xl text-center w-full">
                Generating your image, please wait...
            </div>
            <div v-else-if="!savedImages[0]" class="text-neutral-400 text-lg text-center w-full">
                Type a prompt above and click 'Generate Cover' to generate an image.
            </div>
            <img
            v-else
            v-for="images in savedImages"
            :src="images" 
            alt="Generated comic cover"
            class="max-w-md max-h-1/4  w-96 rounded-lg shadow-lg ml-4"
            />
        </div>
    </AuthenticatedLayout>
</template>